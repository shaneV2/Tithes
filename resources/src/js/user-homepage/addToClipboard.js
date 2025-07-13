document.addEventListener("DOMContentLoaded", () => {
    const code_section = document.getElementById("code-section")
    const img_element = document.getElementById("copy-img-element")
    const img_filepath = "../../src/assets/svg/check-no-fill.svg"
    const u_code = document.getElementById("user-code").textContent;
  
    code_section.addEventListener("click", () => {
        navigator.clipboard.writeText(u_code)
        img_element.src = img_filepath
    })
})