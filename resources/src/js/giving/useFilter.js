import filterDate from "./filterDate.js"

document.addEventListener("DOMContentLoaded", () => {
    const submit_btn = document.getElementById("submit-btn")
    submit_btn.addEventListener("click", filterDate)
})