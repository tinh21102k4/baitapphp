    // JavaScript để chạy slideshow tự động
    let slideIndex = 0;
    showSlides();

    function showSlides() {
    let slides = document.getElementsByClassName("slideshow")[0].getElementsByTagName("img");
    for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
}
    slideIndex++;
    if (slideIndex > slides.length) {
    slideIndex = 1;
}
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 1500); // Thời gian chờ giữa các slide (1 giây trong ví dụ này)
}
