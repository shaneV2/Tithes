import { getAllMembers } from "./membersUtils.js"

document.addEventListener("DOMContentLoaded", () => {
    const search_input = document.getElementById("search-member-input")
    const search_icon = document.getElementById("search-member-btn")
    const close_icon = document.getElementById("close-member-btn")

    search_input.addEventListener("keypress", (e) => {if (e.key == "Enter"){e.preventDefault()}}) // Prevent form from being submitted when enter is pressed.
    // Toggle icon
    search_input.addEventListener("input", (e) => {
        if (e.target.value != ""){
            search_icon.style.display = "none"
            close_icon.style.display = "flex"
        }else {
            close_icon.style.display = "none"
            search_icon.style.display = "flex"
        }
    })    

    close_icon.addEventListener("click", async () => {
        search_input.value = ""
        close_icon.style.display = "none"
        search_icon.style.display = "flex"
        await getAllMembers()
    })
})