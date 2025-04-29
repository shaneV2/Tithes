const add_date_modal = document.getElementById("add-date-section");
const modal_content = document.getElementsByClassName("modal")[0];
const add_date_btn = document.getElementById("add-date-btn");
const close_add_date_modal_btn = document.getElementById("close-btn");
add_date_modal.style.display = "none";

add_date_modal.addEventListener("click", (e) => {add_date_modal.style.display = "none";})
modal_content.addEventListener("click", (e) => {e.stopPropagation();})
add_date_btn.addEventListener("click", () => {add_date_modal.style.display = "flex";})
close_add_date_modal_btn.addEventListener("click", () => {add_date_modal.style.display = "none";})



