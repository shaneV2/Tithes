import numberToWordConversion from "./numberToWordConversion.js";

export default async function getUserSavings(){
    const amount_div = document.getElementById("amount");
    const amount_spell = document.getElementById("amount-spell");
    const filepath = "./queries.php?action=get-user-savings";

    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();
        amount_div.textContent = data
        
        const num_str = data.replace(/,/g, '')
        const number = Number(num_str).toFixed(2)
        amount_spell.textContent = numberToWordConversion(number)
    } catch (error) {
        console.error("Fetch error")
    }
}

document.addEventListener("DOMContentLoaded", () => {
    getUserSavings();
})