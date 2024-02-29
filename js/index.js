const ICONS = document.getElementById('icon-header-menu')
const HEADER_MENU = document.getElementById('header-menu')

ICONS.addEventListener("click", () => {
    HEADER_MENU.classList.toggle('active');
})

const NEW_USER_IMAGE_LINK = document.getElementById('new-user-image-link');
const NEW_USER_IMAGE = document.getElementById('imageToUpload');
const SUBMIT_NEW_IMAGE = document.getElementById('submit-new-image');

NEW_USER_IMAGE_LINK.onclick = function () {
    NEW_USER_IMAGE.click();
    return false;
}

NEW_USER_IMAGE.onchange = function () {
    SUBMIT_NEW_IMAGE.click();
    return false;
}
