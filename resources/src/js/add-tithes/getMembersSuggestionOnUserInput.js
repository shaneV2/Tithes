document.addEventListener("DOMContentLoaded", () => {
    const name_input_field = document.getElementById("name");
    const m_id_input = document.getElementById("m_id");
    const name_suggestion_section = document.getElementById("name-fill-section");

    let added_user = null;
    name_suggestion_section.addEventListener("click", (e) => {
        let id = e.target.getAttribute("m_id")
        let suggested_name = e.target.textContent
        added_user = suggested_name

        m_id_input.value = id;
        name_input_field.value = suggested_name
        name_suggestion_section.style.display = "none"

        setNameStatusToUserAdded()
    })

    name_input_field.addEventListener("input", (e) => {
        getMembersSuggestionOnUserInput(e.target.value)
        if (added_user != name_input_field.value.trim()){
            m_id_input.value = ""
            added_user = null
            setNameStatusToDummy(e.target.value)
        }
    })
})

async function getMembersSuggestionOnUserInput(keyword){
    const name_suggestion_section = document.getElementById("name-fill-section");
    const filepath = "./queries.php?action=get-members-for-suggestion&keyword=" + keyword;

    if (keyword == null || keyword == ""){
        name_suggestion_section.style.display = "none"
        return
    }

    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();
        name_suggestion_section.innerHTML = data
    } catch (error) {
        console.error("Fetch error ", error)
        members_div.innerHTML = "Failed to load dates";
    }

    name_suggestion_section.style.display = "block"
}

function setNameStatusToDummy(){
    const status_dummy_div = document.getElementById("dummy-status");
    const status_user_added_img = document.getElementById("status-img-user-added");

    status_user_added_img.style.display = "none"
    status_dummy_div.style.display = "block"
}

function setNameStatusToUserAdded(){
    const status_dummy_div = document.getElementById("dummy-status");
    const status_user_added_img = document.getElementById("status-img-user-added");

    status_dummy_div.style.display = "none"
    status_user_added_img.style.display = "block"
}

function checkCharacterBeforeCursor(){
    const name_input_field = document.getElementById("name");

    const position = name_input_field.selectionStart
    if (position > 0){
        const charBeforeCursor = name_input_field.value.charAt(position - 1)
        return charBeforeCursor
    }
}