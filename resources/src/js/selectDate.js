let isMonthOptionOpen = false;
let isYearOptionOpen = false;

document.addEventListener("DOMContentLoaded", () => {
    const month_container = document.querySelectorAll(".select-container")[0];
    const year_container = document.querySelectorAll(".select-container")[1];

    const month_options = document.getElementById("months-options");
    const year_options = document.getElementById("years-options");

    month_options.style.display = "none";
    year_options.style.display = "none";

    month_container.addEventListener("click", () => {
        if (isMonthOptionOpen){
            month_options.style.display = "none";
            isMonthOptionOpen = false
        }else if (isYearOptionOpen  || isMonthOptionOpen == false){
            isYearOptionOpen = false
            isMonthOptionOpen = true
            year_options.style.display = "none";
            month_options.style.display = "grid";
        }
    })

    year_container.addEventListener("click", () => {
        if (isYearOptionOpen){
            year_options.style.display = "none";
            isYearOptionOpen = false
        }else if(isMonthOptionOpen || isYearOptionOpen == false){
            isMonthOptionOpen = false
            isYearOptionOpen = true
            month_options.style.display = "none";
            year_options.style.display = "grid";
        }
    })
})

export default function resetDropdowns() {
    const month_options = document.getElementById("months-options");
    const year_options = document.getElementById("years-options");

    month_options.style.display = "none";
    year_options.style.display = "none";

    isMonthOptionOpen = false;
    isYearOptionOpen = false;
}

