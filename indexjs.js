let subprofile = document.getElementById("subprofile");
function toggleProfile() {
    subprofile.classList.toggle("open-profile");
}
let searchid = document.getElementById("searchid");
let navleft = document.getElementById("navleft");
let offset = document.getElementById("offset");
function toggleSearch() {
    searchid.classList.toggle("open-search");
    navleft.classList.toggle("search-clicked");
}
function toggleMenu() {
    navleft.classList.toggle("open-menu");
    offset.classList.toggle("open-menu-clicked");
}
window.addEventListener("resize", function () {
    if (window.innerWidth > 875) {
        navleft.classList.remove("open-menu");
        offset.classList.remove("open-menu-clicked");
    }
    if (window.innerWidth > 1070) {
        searchid.classList.remove("open-search");
    }

});
function search() {
    if (window.innerWidth > 1070) {
        toggleSearch();
    }
}
search();
