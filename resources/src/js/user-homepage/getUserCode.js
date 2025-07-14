export default async function getUserCode(){
    const user_code_div = document.getElementById("user-code");
    const filepath = "./queries.php?action=get-user-code";

    try {
        const response = await fetch(filepath, {method: "POST"});
        if (!response.ok) throw new Error("Network error. Make sure you are connected to the internet.");
        const data = await response.text();
        if (data.trim !== ""){
            user_code_div.textContent = data
        }
    } catch (error) {
        console.error("Fetch error")
    }
}

document.addEventListener("DOMContentLoaded", () => {
    getUserCode();
})