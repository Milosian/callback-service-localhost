const form = document.querySelector('.callback-widget #callbackForm');
const result = document.querySelector('.callback-widget #result');
const panel = document.querySelector('.callback-widget #callbackPanel');
const toggleButton = document.querySelector('.callback-widget #toggleFormButton');
const closeButton = document.querySelector('.callback-widget #closeFormButton');

const apiUrl = callbackWidgetData?.apiUrl || "https://188.33.34.8:3000/api/callback";

    function openPanel() {
      panel.classList.add('open');
      toggleButton.classList.add('hidden');
      toggleButton.setAttribute('aria-expanded', 'true');
    }

    function closePanel() {
      panel.classList.remove('open');
      toggleButton.classList.remove('hidden');
      toggleButton.setAttribute('aria-expanded', 'false');
    }

    toggleButton.addEventListener('click', openPanel);
    closeButton.addEventListener('click', closePanel);

    form.addEventListener('submit', async e => {
      e.preventDefault();
      const formData = Object.fromEntries(new FormData(form));
      const submitBtn = form.querySelector('button');
      submitBtn.disabled = true;
      result.textContent = '';
      result.className = '';

      try {
        const response = await fetch(apiUrl, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(formData)
        });
        const data = await response.json();

        if (data.success) {
          result.classList.add('success');
          result.textContent = data.message || 'Twoje zgłoszenie zostało wysłane';
          form.reset();
        } else {
          result.classList.add('error');
          result.textContent = data.error || 'Coś poszło nie tak podczas wysyłania twojego zgłoszenia';
        }
      } catch (error) {
        result.classList.add('error');
        result.textContent = 'Problem z połączeniem - spróbuj ponownie poźniej';
      } finally {
        submitBtn.disabled = false;
      }
    });