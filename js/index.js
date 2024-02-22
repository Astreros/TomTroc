const ICONS = document.getElementById('icon-header-menu')
const HEADER_MENU = document.getElementById('header-menu')

ICONS.addEventListener("click", () => {
    HEADER_MENU.classList.toggle('active');
})

