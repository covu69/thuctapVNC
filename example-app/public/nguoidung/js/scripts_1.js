const slides = document.querySelector('.slides');
const slideImages = document.querySelectorAll('.slides img');
const progressBar = document.querySelector('.progress-bar');
let currentSlide = 0;

function showSlide(n) {
    currentSlide = (n + slideImages.length) % slideImages.length;
    slides.style.transform = `translateX(-${currentSlide * 100}%)`;
    updateProgressBar();
}

function changeSlide(n) {
    showSlide(currentSlide + n);
}

function autoSlide() {
    changeSlide(1);
}

function updateProgressBar() {
    const progress = ((currentSlide + 1) / slideImages.length) * 100;
    progressBar.style.width = `${progress}%`;
}

setInterval(autoSlide, 6000); // Chuyển tự động sau 6 giây

showSlide(currentSlide);
