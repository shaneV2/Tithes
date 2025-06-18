export default async function getAllMembers() {
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