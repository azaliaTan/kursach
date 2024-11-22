'use sctrict';

function toggleReadMore(element) {
    const shortText = element.previousElementSibling.previousElementSibling;
    const fullText = element.previousElementSibling;

    if (fullText.style.display === "none") {
        fullText.style.display = "block";
        shortText.style.display = "none";
        element.innerText = "скрыть";
    } else {
        fullText.style.display = "none";
        shortText.style.display = "block";
        element.innerText = "читать подробнее";
    }
}