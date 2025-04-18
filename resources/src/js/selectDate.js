document.addEventListener("DOMContentLoaded", () => {
    const month_container = document.querySelectorAll(".select-container")[0];
    const year_container = document.querySelectorAll(".select-container")[1];

    const month_options = document.getElementById("months-options");
    const year_options = document.getElementById("years-options");

    let isMonthOptionOpen = false;
    let isYearOptionOpen = false;

    month_container.addEventListener("click", () => {
        if (isMonthOptionOpen){
            month_options.style.display = "none";
        }else{
            month_options.style.display = "grid";
        }
        isMonthOptionOpen = !isMonthOptionOpen;
    })

    year_container.addEventListener("click", () => {
        if (isYearOptionOpen){
            year_options.style.display = "none";
        }else{
            year_options.style.display = "grid";
        }
        isYearOptionOpen = !isYearOptionOpen;
    })
})