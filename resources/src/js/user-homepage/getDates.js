export default async function getDates() {
    const date_list_div = document.getElementById("date-list");
    const filepath = "./queries.php?action=get-user-contributions";

    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();
        date_list_div.innerHTML = data;

    } catch (error) {
        console.error("Fetch error: " + error)
        date_list_div.innerHTML = "Failed to load contributions";
    }
}