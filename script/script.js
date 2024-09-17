const cardCarousel = document.getElementById("card-carousel");
const cards = document.querySelectorAll(".card");
const maxPhotos = 6;
const limitedCards = Array.from(cards).slice(0, maxPhotos);
let currentIndex = 0;

function showCard(index) {
  limitedCards.forEach((card) => card.classList.remove("selected-card"));
  limitedCards[index].classList.add("selected-card");

  const cardWidth =
    limitedCards[0].offsetWidth +
    parseInt(getComputedStyle(limitedCards[0]).marginRight);
  const containerWidth =
    limitedCards.length *
    (cardWidth - parseInt(getComputedStyle(limitedCards[0]).marginRight));
  const translateValue = Math.min(0, -index * cardWidth);
  cardCarousel.style.width = `${containerWidth}px`;
  cardCarousel.style.transform = `translateX(${translateValue}px)`;
}

function nextCard() {
  currentIndex = (currentIndex + 1) % limitedCards.length;
  showCard(currentIndex);
  if (currentIndex === limitedCards.length - 1) {
    // If the last card is reached, reset to the first card after a delay
    setTimeout(() => {
      currentIndex = 0;
      showCard(currentIndex);
    }, 500);
  }
}

function prevCard() {
  currentIndex = (currentIndex - 1 + limitedCards.length) % limitedCards.length;
  showCard(currentIndex);
}

function autoAdvance() {
  setInterval(() => {
    nextCard();
  }, 3000); // Adjust the time interval (in milliseconds) as needed
}

showCard(currentIndex);
autoAdvance();
