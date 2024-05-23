const optionsPoints = document.querySelectorAll('.optionsPoints');
const optionButton = document.querySelectorAll('.optionButton');
const invisibleOverlay = document.querySelector('.invisibleOverlay');



const closeOptionsList = () => {
    optionButton.forEach((list) => {
        list.classList.add('hidden');
    });
    invisibleOverlay.classList.add('hidden');
}

document.addEventListener("DOMContentLoaded", function() {
    optionsPoints.forEach((but, index) => {
        console.log('chales');
        but.addEventListener('click', () => {
            optionButton[index].classList.remove('hidden');
            invisibleOverlay.classList.remove('hidden');
        });
    });
    invisibleOverlay.addEventListener('click', closeOptionsList);

});