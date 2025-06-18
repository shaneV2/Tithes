export let current_delete_member_id = null;

export async function getAllMembers() {
    const members_div = document.getElementById("members");
    const filepath = "./queries.php?action=get-all-members";
    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Error: Unable to fetch data.");
        const data = await response.text();
        members_div.innerHTML = data;

    } catch (error) {
        console.error("Fetch error: ", error)
        members_div.innerHTML = "Failed to load members.";
    }
}

export async function searchMember(keyword){
    const members_div = document.getElementById("members")
    const filepath = "./queries.php?action=search-member&keyword=" + keyword; 
    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Unable to get data.");
        const data = await response.text()
        members_div.innerHTML = data

    } catch (error) { console.error("Error: " + error) } 
}

export async function removeMember() {
    const filepath = "./queries.php?action=remove-member"; 
    try {
        const response = await fetch(filepath, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "m_id=" + encodeURIComponent(current_delete_member_id)
        });
        if (!response.ok) throw new Error("Unable to remove data.");
    } catch (error) { console.error("Error: " + error) } 
}

export function setupEventListeners(){
    const warning_modal = document.getElementById("warning-modal")
    const warning_modal_child = document.getElementById("warning-div")
    const cancel_btn = document.getElementById("warning-cancel-btn")
    const delete_btn = document.getElementById("warning-delete-btn")
    const search_input = document.getElementById("search-member-input")

    const members_list_div = document.getElementById("members")
    members_list_div.addEventListener("click", (e) => {
        if (e.target.classList.contains('remove-btn')){
            current_delete_member_id = e.target.getAttribute('md_id')
            warning_modal.style.display = 'flex'
        }
    })
    
    search_input.addEventListener("input", async (e) => {
        if (e.target.value.trim() == ""){
            await getAllMembers()
        }else {
            await searchMember(e.target.value)
        }
    })

    // Add event listeners to warning modal
    warning_modal.addEventListener("click", closeWarningModal)
    warning_modal_child.addEventListener("click", (e) => {e.stopPropagation()})
    cancel_btn.addEventListener("click", closeWarningModal)
    delete_btn.addEventListener("click", async () => {
        await removeMember()

        const keyword = search_input.value.trim()
        if (keyword == ""){
            await getAllMembers()
        }else {
            await searchMember(keyword)
        }
        closeWarningModal(warning_modal)
    })
}

function closeWarningModal(){
    const warning_modal = document.getElementById("warning-modal")
    warning_modal.style.display = "none" 
}