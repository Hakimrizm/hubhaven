document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("main-navbar");

  function updateNavbarClass() {
    if (window.scrollY > 0) {
      navbar.classList.add("bg-dark", "navbar-dark");
    } else {
      navbar.classList.remove("bg-dark", "navbar-dark");
    }
  }

  updateNavbarClass();

  window.addEventListener("scroll", updateNavbarClass);
});
