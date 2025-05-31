import setupMemberActions from "./setupMemberActions.js";

async function getMembersBasedOnDate(date_id) {
    const members_div = document.getElementById("members");
    const filepath = "./queries.php?action=get-members-based-on-date&d_id=" + date_id;

    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();
        members_div.innerHTML = data;

        setupMemberActions()
    } catch (error) {
        console.error("Fetch error ", error)
        members_div.innerHTML = "Failed to load dates";
    }
}

const queryString = window.location.search;
const URLparams = new URLSearchParams(queryString);
const date_id = URLparams.get("d_id");
document.addEventListener("DOMContentLoaded", function (){
    getMembersBasedOnDate(date_id);
})

export default function refreshMemberList(){
    getMembersBasedOnDate(date_id)
}