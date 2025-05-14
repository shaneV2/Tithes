document.addEventListener("DOMContentLoaded", function(){
    const view_shares_btn = document.getElementById("view-shares-btn");
    const shares_modal = document.getElementById("shares-modal");
    const inner_modal = document.getElementById("inner-modal");
    const shares_close_btn = document.getElementById("shares-close-btn");
    
    view_shares_btn.addEventListener("click", () => {
        shares_modal.style.display = "flex";
    })
    shares_modal.addEventListener("click", () => {
        shares_modal.style.display = "none";
    })
    inner_modal.addEventListener("click", (e) => {
        e.stopPropagation();
    })
    shares_close_btn.addEventListener("click", () => {
        shares_modal.style.display = "none";
    })

    getShares()
})


async function getShares() {
    const inner_modal = document.getElementById("inner-modal");
    
    const date_id = new URLSearchParams(window.location.search).get('d_id');
    const filepath = "./queries.php?action=view-shares&d_id=" + date_id;
    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();
        
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