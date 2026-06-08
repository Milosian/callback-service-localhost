require('dotenv').config();
const nodemailer = require('nodemailer');

(async () => {
  const transporter = nodemailer.createTransport({
    host: process.env.SMTP_HOST,
    port: Number(process.env.SMTP_PORT),
    secure: false,
    auth: {
      user: process.env.SMTP_USER,
      pass: process.env.SMTP_PASS,
    },
    logger: true,
    debug: true,
  });

  try {
    await transporter.verify();            // checks connection + auth
    console.log('✅ SMTP connection works!');

    // optional: send a test message
    await transporter.sendMail({
      from: process.env.SMTP_FROM,
      to: process.env.SMTP_TO,
      subject: 'Callback service test',
      text: 'This is a test email from your callback service.',
    });
    console.log('📧 Test email sent.');
  } catch (err) {
    console.error('❌ SMTP test failed:', err.message);
  }
})();
