let month = document.getElementById("month")[0];
let month_buttons = document.querySelectorAll(".month-btn");
const month_options = document.getElementById("months-options");

function selectMonth(e){
    let text_month = e.target.textContent
    month.textContent = text_month
    month.value = text_month
    month_options.style.display = "none"
}

month_buttons.forEach(btn => {
    btn.addEventListener("click", selectMonth)
})
