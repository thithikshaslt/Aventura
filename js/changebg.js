window.onload = function() {
    var image = document.querySelector(".content");

    var images = [
        'url(images/slideshow/img1.jpg)',
        'url(images/slideshow/img2.jpg)',
        'url(images/slideshow/img3.jpg)',
        'url(images/slideshow/img4.jpg)',
        'url(images/slideshow/img5.jpg)',
        'url(images/slideshow/img6.jpg)',
        'url(images/slideshow/img7.jpg)'
    ];

    console.log("Image element:", image);

    var i = Math.floor(images.length * Math.random());
    console.log(i);

    image.style.backgroundImage = images[i];
    image.style.backgroundSize = "cover";
    image.style.backgroundRepeat = "no-repeat";
    image.style.backgroundPosition = "center";
};
