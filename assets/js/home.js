const carousel = document.querySelector(".carousel");
const slider = document.querySelector(".carousel .slider");
const thumbnail = document.querySelector(".carousel .thumbnail");

const timeRunning = 600;
const autoNext = 4000;
let runTimeOut;
let runAutoNext = setTimeout(() => {
  showSlider("next");
}, autoNext);

const showSlider = (type) => {
  const sliderItems = document.querySelectorAll(".slider .item");
  const thumbnailItems = document.querySelectorAll(".thumbnail .item");

  if (type === "next") {
    slider.appendChild(sliderItems[0]);
    thumbnail.appendChild(thumbnailItems[0]);
    carousel.classList.add("next");
  } else {
    let positionLastItem = sliderItems.length - 1;
    slider.prepend(sliderItems[positionLastItem]);
    thumbnail.prepend(thumbnailItems[positionLastItem]);
    carousel.classList.add("prev");
  }

  clearTimeout(runTimeOut);
  runTimeOut = setTimeout(() => {
    carousel.classList.remove("next");
    carousel.classList.remove("prev");
  }, timeRunning);

  clearTimeout(runAutoNext);
  runAutoNext = setTimeout(() => {
    showSlider("next");
  }, autoNext);
};
