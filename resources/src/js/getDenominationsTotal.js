document.addEventListener("DOMContentLoaded", function() {
    const tithes_table_wrapper = document.getElementById('tithes-table-wrapper')
    getDenominationsTotal(tithes_table_wrapper);
})


async function getDenominationsTotal(tithes_table_wrapper){
    const date_id = new URLSearchParams(window.location.search).get('d_id')
    const filepath = "./queries.php?action=get-denominations-total&d_id=" + date_id;

    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();

        // Create temporary wrapper
        // Append elements to tithes table 
        const temporary_wrapper = document.createElement('div')
        temporary_wrapper.innerHTML = data
        if (temporary_wrapper.firstChild){
            tithes_table_wrapper.appendChild(temporary_wrapper.firstChild)
        }
    } catch (error) {
        console.error(error)
        tithes_table_wrapper.innerHTML = "Failed to load denominations."
    }
}
