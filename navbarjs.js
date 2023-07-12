let subprofile = document.getElementById("subprofile");
function toggleProfile() {  // function to toggle the wrapper containing profile-details
    subprofile.classList.toggle("open-profile");
}
let searchid = document.getElementById("searchid");
let navleft = document.getElementById("navleft");
let offset = document.getElementById("offset");
function toggleSearch() {   // function to toggle search bar to make it responsive
    searchid.classList.toggle("open-search");
    navleft.classList.toggle("search-clicked");
}
function toggleMenu() { // toggling nav bar menu to make it responsive
    navleft.classList.toggle("open-menu");
    offset.classList.toggle("open-menu-clicked");
}
window.addEventListener("resize", function () { // to make page responsive by detecting window resizing
    if (window.innerWidth > 875) {
        navleft.classList.remove("open-menu");
        offset.classList.remove("open-menu-clicked");
    }
    if (window.innerWidth > 1070) {
        searchid.classList.remove("open-search");
    }

});
function search() { // toggling search based on window size
    if (window.innerWidth > 1070) {
        toggleSearch();
    }
}
search();
