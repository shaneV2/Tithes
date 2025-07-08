import getDenominationsTotal from "./getDenominationsTotal.js";
import getShares from "./viewShares.js";
import getMembersBasedOnDate from "./members.js";

let current_delete_member_id = null;
document.addEventListener("DOMContentLoaded", () => {
    const members_list_div = document.getElementById("members")
    
    const warning_modal = document.getElementById("warning-modal")
    const warning_modal_child = document.getElementById("warning-div")
    const cancel_btn = document.getElementById("warning-cancel-btn")
    const delete_btn = document.getElementById("warning-delete-btn")

    members_list_div.addEventListener("click", (e) => {
        if (e.target.classList.contains('delete-btn')){
            current_delete_member_id = e.target.getAttribute('md_id')
            warning_modal.style.display = 'flex'
        }
    })
    // Add event listeners to warning modal
    warning_modal.addEventListener("click", closeWarningModal)
    warning_modal_child.addEventListener("click", (e) => {e.stopPropagation()})
    cancel_btn.addEventListener("click", closeWarningModal)
    delete_btn.addEventListener("click", async () => {
        await deleteDateMember()
        current_delete_member_id = null
        closeWarningModal()
        await getShares()
        await getDenominationsTotal()
        await getMembersBasedOnDate()
    })

    function closeWarningModal(){warning_modal.style.display = "none"}
})

async function deleteDateMember() {
    const filepath = "./queries.php?action=delete-date-member";
    try {
        const response = await fetch(filepath, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "md_id=" + encodeURIComponent(current_delete_member_id)
        });
        if (!response.ok) throw new Error("Unable to delete date.");
    } catch (error) { console.error("Error: " + error) } 
}