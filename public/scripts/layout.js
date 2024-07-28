
const productButton = document.getElementById('productButton');
const productIcon = document.getElementById('productIcon');
const productMenu = document.getElementById('productMenu');

productButton.addEventListener('click', () => {
    const expanded = productButton.getAttribute('aria-expanded') === 'true' || false;
    productButton.setAttribute('aria-expanded', !expanded);
    productMenu.classList.toggle('hidden');
    productMenu.classList.toggle('block');
    productIcon.classList.toggle('rotate-180');
});
