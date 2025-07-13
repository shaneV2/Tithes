import getDates from "./getDates.js"
import filterDate from "./filterDate.js";
import checkIfFilterEnabled from "./filterUtils.js";
import clearFilter from "./clearFilter.js";

document.addEventListener("DOMContentLoaded", () => {
    const clear_filter_btn = document.getElementById("clear-filter-btn")

    clear_filter_btn.addEventListener("click", async ()=> {
        clearFilter()
        await getDates()
    })

    if (checkIfFilterEnabled() == true){
        filterDate()
    }else {
        getDates()
    }
})