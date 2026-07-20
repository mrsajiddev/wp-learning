document.addEventListener("DOMContentLoaded", function () {
  const menuBtn = document.querySelector(".menu-toggle");
  const nav = document.querySelector(".main-navigation");
  menuBtn.addEventListener("click", function () {
    nav.classList.toggle("active");
  });
});
