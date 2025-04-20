const year = document.getElementById("year");
const year_buttons = document.querySelectorAll(".year-btn");
const year_options = document.getElementById("years-options");

function selectYear(e){
    let text_year = e.target.textContent
    year.textContent = text_year
    year.value = text_year
    year_options.style.display = "none"
}

year_buttons.forEach(btn => {
    btn.addEventListener("click", selectYear)
})