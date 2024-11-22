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
            } else if (this.textContent.trim() === 'Отклики') {
                this.classList.add('active'); // Активируем вкладку Отклики
                listContainer.style.display = 'grid'; // Показываем контейнер откликов
                
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
    });

    // Получаем все элементы с классом item
    const items = document.querySelectorAll('.list_2 .item');

    items.forEach((item, index) => {
        item.addEventListener('click', (event) => {
            event.stopPropagation(); // Останавливаем всплытие события
            // Проверяем, если элемент уже активен
            const isActive = item.classList.contains('active');

            // Сначала убираем активное состояние у всех элементов
            items.forEach(i => i.classList.remove('active'));

            // Если элемент не был активен, добавляем активное состояние
            if (!isActive) {
                item.classList.add('active');

                // Если это первый элемент, активируем также второй
                if (index === 0) {
                    if (items[index + 1]) {
                        items[index + 1].classList.add('active');
                    }
                } else if (index === items.length - 1) {
                    // Если это последний элемент, активируем предыдущий
                    if (items[index - 1]) {
                        items[index - 1].classList.add('active');
                    }
                } else {
                    // И для всех остальных просто активируем текущий
                    if (items[index - 1]) {
                        items[index - 1].classList.add('active');
                    }
                    if (items[index + 1]) {
                        items[index + 1].classList.add('active');
                    }
                }
            }
        });
    });

    // Обработчик клика по документу для закрытия элементов
    document.addEventListener('click', () => {
        // Убираем класс active у всех элементов
        items.forEach(i => {
            i.classList.remove('active');
        });
    });

    // Также можно добавить обработчик для скрытия активного элемента
    // при клике на элемент
    items.forEach(item => {
        item.addEventListener('click', (event) => {
            // Убираем класс active у всех элементов
            items.forEach(i => {
                i.classList.remove('active');
            });
            // Добавляем класс active к текущему элементу
            item.classList.add('active');
        });
    });
});