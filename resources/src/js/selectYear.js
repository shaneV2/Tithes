import resetDropdowns from "./selectDate.js";

document.addEventListener("DOMContentLoaded", () => {
    setYearsOptionsDynamically()
    const year = document.getElementById("year");
    const year_buttons = document.querySelectorAll(".year-btn");
    const year_options = document.getElementById("years-options");
    
    function selectYear(e){
        let text_year = e.target.textContent
        year.textContent = text_year
        year.value = text_year
        year_options.style.display = "none"
        resetDropdowns()
    }
    
    year_buttons.forEach(btn => {
        btn.addEventListener("click", selectYear)
    })
})

function setYearsOptionsDynamically(){
    const wrapper = document.getElementById("years-options-wrapper")
    const current_year = new Date().getFullYear()
    let year = 2001
    while (year <= current_year){
        const button_div = document.createElement("button")
        button_div.classList.add("year-btn")
        button_div.innerText = year

        wrapper.prepend(button_div)
        year += 1
    }
    
} 
