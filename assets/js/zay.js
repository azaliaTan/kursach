'use strict';
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tabss');
    const listContainer = document.querySelector('.list');
    const listContainer2 = document.querySelector('.list_2');
    

    // Начальные установки
    listContainer.style.display = 'none'; // Скрываем контейнер откликов
    listContainer2.style.display = 'grid'; // Показываем контейнер постов
    tabs[0].classList.add('active'); // Активируем первую вкладку

    tabs.forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault(); // Оставляем клики по ссылкам простыми
            tabs.forEach(t => t.classList.remove('active')); // Сброс активных вкладок
            listContainer.style.display = 'none'; // Скрываем контейнер откликов
            listContainer2.style.display = 'none'; // Скрываем контейнер постов

            if (this.textContent.trim() === 'Посты') {
                this.classList.add('active'); // Активируем вкладку Посты
                listContainer2.style.display = 'grid'; // Показываем контейнер постов
            } else if (this.textContent.trim() === 'Отзывы') {
                this.classList.add('active'); // Активируем вкладку Отклики
                listContainer.style.display = 'flex'; // Показываем контейнер откликов
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tabss'); // Вкладки
    const listContainer = document.querySelector('.list_2'); // Новая обертка для списка

    // Убедитесь, что контейнер изначально отображается
    listContainer.style.display = 'grid'; // Открываем контейнер
    tabs[0].classList.add('active'); // Делаем первую вкладку активной

    // Функция для сброса активных вкладок и скрытия контейнера
    function resetTabs() {
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        listContainer.style.display = 'none'; // Скрываем контейнер по умолчанию
    }

    // Обработчик события для вкладок
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault(); // Отменяем стандартное поведение ссылки

            resetTabs(); // Сбрасываем активность всех вкладок

            // Проверяем, на какую вкладку нажали
            if (this.textContent === 'Посты') {
                listContainer.style.display = 'grid'; // Показываем контейнер для вкладки "Посты"
            }
            this.classList.add('active'); // Делаем текущую вкладку активной
        });
    });})