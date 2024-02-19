let btnOpenModal = document.getElementById("add-product-cta");
let closeModal = document.getElementById("btn-close-modal");

btnOpenModal.addEventListener("click", () => {
  gsap.to(".overlay-modal", {
    y: 0,
    ease: "power2.Out",
    duration: 0.7,
  });
});

closeModal.addEventListener("click", () => {
  gsap.to(".overlay-modal", {
    y: "-100%",
    ease: "power2.Out",
    duration: 0.7,
  });
});
