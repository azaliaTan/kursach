'use strict';

const modal = document.getElementById("myModal");
const closeButton = document.querySelector(".modal-content .close");

function openModal() {
    modal.style.display = "block"; 
}

function closeModal() {
    modal.style.display = "none"; 
}

// Закрытие модального окна по клику на кнопку
closeButton.addEventListener("click", closeModal); 

// Открываем модальное окно при успешной отправке формы
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("ad"); // Замените на id вашей формы

    form.addEventListener("submit", function(event) {
        // Убедитесь, что форма валидна перед отправкой
        if (!event.target.checkValidity()) {
            event.preventDefault(); // Остановите отправку, если форма не валидна
        } else {
            // Если все прошло успешно, показываем модал
            openModal();
            event.preventDefault(); // Остановите отправку формы для демонстрации модального окна
            // Здесь вы можете добавить код для отправки данных на сервер, если это необходимо
        }
    });
});
