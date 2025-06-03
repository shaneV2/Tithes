import getDates from "./getDates.js"
import filterDate from "./filterDate.js";
import checkIfFilterEnabled from "./filterUtils.js";
import clearFilter from "./clearFilter.js";

let current_delete_date_id = null;
document.addEventListener("DOMContentLoaded", () => {
    const date_list_div = document.getElementById("date-list")
    const add_date_section = document.getElementById("add-date-section")

    const warning_modal = document.getElementById("warning-modal")
    const warning_modal_child = document.getElementById("warning-div")
    const cancel_btn = document.getElementById("warning-cancel-btn")
    const delete_btn = document.getElementById("warning-delete-btn")
    const clear_filter_btn = document.getElementById("clear-filter-btn")
    
    add_date_section.style.display = "none"
    
    date_list_div.addEventListener("click", (e) => {
        if (e.target.classList.contains('delete-btn')){
            current_delete_date_id = e.target.getAttribute('did')
            warning_modal.style.display = 'flex'
        }
    })
    clear_filter_btn.addEventListener("click", async ()=> {
        clearFilter()
        await getDates()
    })

    function closeWarningModal(){warning_modal.style.display = "none"}

    // Add event listeners to warning modal
    warning_modal.addEventListener("click", closeWarningModal)
    warning_modal_child.addEventListener("click", (e) => {e.stopPropagation()})
    cancel_btn.addEventListener("click", closeWarningModal)
    delete_btn.addEventListener("click", async () => {
        await deleteDate()
        current_delete_date_id = null
        closeWarningModal()

        if (checkIfFilterEnabled() == true){
            await filterDate()
        }else {
            await getDates()
        }
    })

    if (checkIfFilterEnabled() == true){
        filterDate()
    }else {
        getDates()
    }
})

async function deleteDate() {
    const filepath = "./queries.php?action=delete-date&date_id=" + current_delete_date_id;  
    try {
        const response = await fetch(filepath, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "date_id=" + encodeURIComponent(current_delete_date_id)
        });
        if (!response.ok) throw new Error("Unable to delete date.");
        const data = response.text()
        console.log(data)
    } catch (error) { console.error("Error: " + error) } 
}