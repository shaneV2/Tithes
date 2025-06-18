import {getAllMembers, setupEventListeners } from "./membersUtils.js";

document.addEventListener("DOMContentLoaded", async () => {
    await getAllMembers();
    setupEventListeners();
})