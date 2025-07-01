document.addEventListener("DOMContentLoaded", () => {
    const name_input_field = document.getElementById("name");
    name_input_field.addEventListener("input", (e) => {
        getMembersSuggestionOnUserInput(e.target.value)
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