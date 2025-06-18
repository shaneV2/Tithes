export default async function searchMember(){
    const members_div = document.getElementById("members");

    const filepath = "./queries.php?action=search-member"; 
    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Unable to remove data.");
        const data = await response.text()

        members_div.innerHTML = data
    } catch (error) { console.error("Error: " + error) } 
}