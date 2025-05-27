let current_delete_date_id = null;
document.addEventListener("DOMContentLoaded", () => {
    const delete_btns  = document.querySelectorAll(".delete-btn")
    const warning_modal = document.getElementById("warning-modal")
    const warning_modal_child = document.getElementById("warning-div")
    const cancel_btn = document.getElementById("warning-cancel-btn")

    delete_btns.forEach(button => {
        button.addEventListener("click", toggleWarningDeleteModal)
    })

    // Add event listeners to warning modal
    warning_modal.addEventListener("click", closeWarningModal)
    warning_modal_child.addEventListener("click", (e) => {e.stopPropagation()})
    cancel_btn.addEventListener("click", closeWarningModal)

    function toggleWarningDeleteModal(e){
        current_delete_date_id = e.target.getAttribute("did");

        if (warning_modal.style.display == "none" || warning_modal.style.display == ""){
            warning_modal.style.display = "flex"
        }else {
            warning_modal.style.display = "none"
        }
    }

    function closeWarningModal(){
        warning_modal.style.display = "none"
    }
})