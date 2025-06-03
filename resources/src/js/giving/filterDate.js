import resetDropdowns from "../selectDate.js";

export default async function filterDate() {
    const month = document.getElementById("month").value
    const year = document.getElementById("year").value

    if (month == "" && year == "") return 

    const date_list_div = document.getElementById("date-list");
    const filepath = "./queries.php?action=filter-date&month=" + month + "&year=" + year;

    try {
        const response = await fetch(filepath);
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();
        date_list_div.innerHTML = data;
        resetDropdowns()

    } catch (error) {
        console.error("Fetch error: " + error)
        date_list_div.innerHTML = "Failed to load dates";
    }
}