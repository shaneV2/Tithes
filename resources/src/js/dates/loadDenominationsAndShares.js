import getDenominationsTotal from "./getDenominationsTotal.js";
import getShares from "./viewShares.js";

document.addEventListener("DOMContentLoaded", () => {
    // Load denominations
    getDenominationsTotal();

    // Load Shares 
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

    getShares(inner_modal)
})