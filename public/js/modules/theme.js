export function theme() {
  const themeMenu = document.getElementsByClassName("theme-menu")[0];
  const html = document.getElementsByTagName("html")[0];
  const buttonTheme = document.querySelectorAll("[data-theme]");
  const icon = document.getElementById("theme-icon");

  const currentTheme = html.getAttribute("data-bs-theme");
  localStorage.setItem("theme", currentTheme);

  function updateIcon(theme) {
    if (theme === "light") {
      icon.className = "bi bi-brightness-high-fill";
    } else {
      icon.className = "bi bi-moon-stars";
    }
  }
  updateIcon(currentTheme);

  buttonTheme.forEach((e) => {
    if (e.dataset.theme == currentTheme) {
      e.classList.add("active");
    }
  });

  themeMenu.addEventListener("click", function (e) {
    const selectedTheme = e.target.dataset.theme;
    html.setAttribute("data-bs-theme", selectedTheme);
    localStorage.setItem("theme", selectedTheme);
    buttonTheme.forEach((e) => e.classList.remove("active"));
    updateIcon(selectedTheme);
    e.target.classList.add("active");
  });
}
