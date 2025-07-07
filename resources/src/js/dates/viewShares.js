export default async function getShares() {
    const inner_modal = document.getElementById("inner-modal");
    const shares_table = document.getElementById("shares-table");
    const date_id = new URLSearchParams(window.location.search).get('d_id');
    const filepath = "./queries.php?action=view-shares&d_id=" + date_id;
    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();

        shares_table.innerHTML = data
        const input_number = document.getElementById("input-pastor-number");
        if (input_number){
            input_number.addEventListener("input", (e) => {calculateSharesBasedOnNumberOfPastors(e.target.value)})
        }

    } catch (error) {
        console.error("Fetch error ", error)
        shares_table.innerHTML = "Failed to load shares.";
    }
}

export function calculateSharesBasedOnNumberOfPastors(numberOfPastors){
    const pastor_shares_div = document.getElementById("pastor_shares");
    const pastor_shares_total = document.getElementById("pastor_shares_total").innerText;

    const pastor_shares_total_integer = parseInt(pastor_shares_total.replace(/,/g, ''))

    if (numberOfPastors <= 0 || numberOfPastors == null){
        let formatted_total_shares = pastor_shares_total_integer.toLocaleString()
        pastor_shares_div.innerText = formatted_total_shares
        return
    }

    let shares = Math.floor(pastor_shares_total_integer / numberOfPastors)
    let formatted_shares = shares.toLocaleString();
    pastor_shares_div.innerText = formatted_shares 
}