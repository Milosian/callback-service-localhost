// server.js --------------------------------------------------------------
require('dotenv').config();               // load .env values

const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const nodemailer = require('nodemailer');
const rateLimit = require('express-rate-limit');
const morgan = require('morgan');

const app = express();
const PORT = process.env.PORT || 3000;

const allowedOrigin = process.env.ALLOWED_ORIGIN || "https://web-lab.free.nf";

// Proxy trust
app.set('trust proxy', 1)

// ---------- Middleware ----------
app.use(morgan('combined'));                      // request logging
app.use(cors({                                   // restrict callers
  origin: allowedOrigin,
  methods: ['POST', 'GET', 'OPTIONS'],
  credentials: true,
}));
app.use(bodyParser.json());

// simple rate limiter: 5 requests per minute per IP
app.use('/api/callback', rateLimit({
  windowMs: 60 * 1000,
  max: 5,
  message: { error: 'Too many requests, please try later' }
}));

// ---------- Email transporter ----------
const transporter = nodemailer.createTransport({
  host: process.env.SMTP_HOST || 'smtp.gmail.com',
  port: Number(process.env.SMTP_PORT),
  secure: false,               // true for 465, false for other ports
  auth: {
    user: process.env.SMTP_USER,
    pass: process.env.SMTP_PASS,
  },
  logger: true,
  debug: !!process.env.SMTP_DEBUG,
});

// ---------- Helper: basic validation ----------
function validate(data) {
  const errors = [];
  if (!data.name || typeof data.name !== 'string') errors.push('name');
  if (!data.phone || typeof data.phone !== 'string') errors.push('phone');
  // optional: regex for phone format, length checks, etc.
  return errors;
}

// ---------- Callback endpoint ----------
app.post('/api/callback', async (req, res) => {
  const { name, phone, message } = req.body;
  const bad = validate({ name, phone });
  if (bad.length) {
    return res.status(400).json({ error: 'Missing/invalid fields', fields: bad });
  }

  const mailOptions = {
    from: `"Website Callback" <${process.env.SMTP_FROM}>`,
    to:   process.env.SMTP_TO,
    subject: `Callback request from ${name}`,
    text: `
      ==== Callback Request ====
      Name   : ${name}
      Phone  : ${phone}
      Message: ${message || '(none)'}
    `.trim(),
  };

  try {
    await transporter.sendMail(mailOptions);
    res.json({ success: true, message: 'Your request has been sent' });
  } catch (err) {
    console.error('✉️  Email error:', err);
    res.status(500).json({ error: 'Failed to send email' });
  }
});

// ---------- Start ----------
app.listen(PORT, () => {
  console.log(`✅ Callback service listening on http://0.0.0.0:${PORT}`);
});
