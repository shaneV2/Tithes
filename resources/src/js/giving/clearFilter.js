import resetDropdowns from "../selectDate.js"

export default function clearFilter(){
    const month = document.getElementById("month")
    const year = document.getElementById("year")

    month.value = ""
    year.value = ""

    async function request() {
        const filepath = "./queries.php?action=clear-session-for-filter";
        try {
            const response = await fetch(filepath);
            if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        } catch (error) {
            console.error("Unable to clear filter: " + error)
        }
    }

    resetDropdowns()
    request()
}