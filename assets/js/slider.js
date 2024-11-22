"use strict";
let sliderBody = document.querySelector('.slider__body');
let sliderNav = document.querySelector('.slider__nav');
let sliderImages = document.querySelector('.slider__images');
let sliderItems = Array.from(document.querySelectorAll('.slider__item'));
let sliderDots = Array.from(document.querySelectorAll('.slider__dot'));

sliderBody.addEventListener('click', function(event){
    let targetArrow = event.target.closest('.slider__arrow');
    if(!targetArrow) return;

    let currentActiveImage = document.querySelector('.slider__item.active');
    let currentActiveIndex = sliderItems.indexOf(currentActiveImage);

    currentActiveImage.classList.remove('active');
    document.querySelector('.slider__dot.active').classList.remove('active');

    changeActive(targetArrow, currentActiveIndex);

    let newActiveImage = document.querySelector('.slider__item.active');
    let newActiveIndex = sliderItems.indexOf(newActiveImage);

    scrollSlider(newActiveIndex);
})
function scrollSlider(index){
    sliderImages.style.transform = `translateX(${-100*index}%)`
}
function changeActive(arrow, currentIndex){
    if(arrow.classList.contains('left')){
        if(currentIndex == 0){
            sliderItems.at(-1).classList.add('active');
            sliderDots.at(-1).classList.add('active');
        }else{
            sliderItems[currentIndex-1].classList.add('active');
            sliderDots[currentIndex-1].classList.add('active');
        }
    }else{
        if(currentIndex == sliderItems.length - 1){
            sliderItems[0].classList.add('active');
            sliderDots[0].classList.add('active');
        }else{
            sliderItems[currentIndex+1].classList.add('active');
            sliderDots[currentIndex+1].classList.add('active');
        }
    }
}

sliderNav.addEventListener('click', function(event){
    let targetDot = event.target.closest('.slider__dot');
    if(!targetDot) return;

    if(targetDot.classList.contains('active')) return;

    document.querySelector('.slider__dot.active').classList.remove('active');
    targetDot.classList.add('active');
    document.querySelector('.slider__item.active').classList.remove('active');

    sliderItems[targetDot.dataset.index].classList.add('active');
    scrollSlider(targetDot.dataset.index);
})