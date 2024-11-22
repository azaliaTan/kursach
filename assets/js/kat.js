'use strict';

document.addEventListener('DOMContentLoaded', () => {
    const slider = document.getElementById('slider');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');

    let categories = [];
    let currentIndex = 0;

    // Функция для обновления слайдера
    function updateSlider() {
        slider.innerHTML = '';
        for (let i = 0; i < 3; i++) {
            const index = currentIndex + i;
            if (index < categories.length) {
                const slide = document.createElement('div');
                slide.className = 'slide';
                slide.innerHTML = `<a href="#">${categories[index].name}</a>`;
                slider.appendChild(slide);
            }
        }
        slider.style.transform = `translateX(-${(currentIndex / 3) * 100}%)`;
    }

   

    // Обработка кнопки "Назад"
    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex -= 3;
            updateSlider();
        }
    });

    // Обработка кнопки "Вперед"
    nextButton.addEventListener('click', () => {
        if (currentIndex < categories.length - 3) {
            currentIndex += 3;
            updateSlider();
        }
    });
});