document.addEventListener("DOMContentLoaded", () => {
    const logout_btn = document.getElementById("logout-btn");
    logout_btn.addEventListener("click", async () => {
        const filepath = "../queries.php?action=logout";
        await fetch(filepath, {method: "POST"})
        window.location.href = "../login.php"
    })
})