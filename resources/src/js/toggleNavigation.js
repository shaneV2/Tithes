const menu_icon = document.getElementById("menu-icon");
const close_menu_icon = document.getElementById("close-menu-icon");
const navigation_pane = document.getElementById("navigation-pane");

navigation_pane.style.display = 'none' // don't show navigation pane on first page load

function toggleNavigationPane(){
    if (navigation_pane.style.display == 'none'){
        navigation_pane.style.display = 'flex'
    }else {
        navigation_pane.style.display = 'none'
    }
}


menu_icon.addEventListener("click", toggleNavigationPane)
close_menu_icon.addEventListener("click", toggleNavigationPane)