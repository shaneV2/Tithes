export default async function getShares() {
    const inner_modal = document.getElementById("inner-modal");
    const date_id = new URLSearchParams(window.location.search).get('d_id');
    const filepath = "./queries.php?action=view-shares&d_id=" + date_id;
    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();

        inner_modal.innerHTML = ""
        const temporary_wrapper = document.createElement('div');
        temporary_wrapper.innerHTML = data;

        if (temporary_wrapper.firstChild){
            inner_modal.appendChild(temporary_wrapper.firstChild)
        }
    } catch (error) {
        console.error("Fetch error ", error)
        shares_div.innerHTML = "Failed to load shares.";
    }
}