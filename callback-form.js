const panel = document.getElementById('callbackPanel');
const toggleButton = document.getElementById('toggleFormButton');
const closeButton = document.getElementById('closeFormButton');

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
