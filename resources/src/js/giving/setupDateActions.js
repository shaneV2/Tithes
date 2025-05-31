import getDates from "./getDates.js";

let current_delete_date_id = null;

export default function setupDateActions(){
    const delete_btns  = document.querySelectorAll(".delete-btn")
    const warning_modal = document.getElementById("warning-modal")
    const warning_modal_child = document.getElementById("warning-div")
    const cancel_btn = document.getElementById("warning-cancel-btn")
    const delete_btn = document.getElementById("warning-delete-btn")

    delete_btns.forEach(button => {button.addEventListener("click", toggleWarningDeleteModal)})

    // Add event listeners to warning modal
    warning_modal.addEventListener("click", closeWarningModal)
    warning_modal_child.addEventListener("click", (e) => {e.stopPropagation()})
    cancel_btn.addEventListener("click", closeWarningModal)
    delete_btn.addEventListener("click", confirmDeleteDate)

    function closeWarningModal(){warning_modal.style.display = "none"}
 
    function toggleWarningDeleteModal(e){
        current_delete_date_id = e.target.getAttribute("did");
        if (warning_modal.style.display == "none" || warning_modal.style.display == ""){
            warning_modal.style.display = "flex"
        }else {
            warning_modal.style.display = "none"
        }
    }

    function confirmDeleteDate(){
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

        // Assign current date id to null
        // Refresh after deleting 
        deleteDate()
        current_delete_date_id = null
        closeWarningModal()
        getDates();
    }
}