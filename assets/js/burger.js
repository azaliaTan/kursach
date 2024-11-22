"use strict";

const burgerIcon = document.querySelector('#burger-icon');
const burgerMenu = document.querySelector('.burger_menu');

burgerIcon.addEventListener('click', () => {
  burgerMenu.classList.toggle('open');
  burgerIcon.src = burgerIcon.src === 'assets/img/burger.png' ? 'assets/img/burg_close.png' : 'assets/img/burger.png';
});

burgerMenu.addEventListener('click', (e) => {
  if (e.target.classList.contains('close')) {
    burgerMenu.classList.toggle('open');
    burgerIcon.src = 'assets/img/burger.png';
  }
});