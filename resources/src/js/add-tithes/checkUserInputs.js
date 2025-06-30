import { total_denominations } from "./denominations.js";
import { total_offerings } from "./userOfferings.js";

let error_div = null
let submit_button = null
export default function checkIfTotalOfferingsAndDenominationsTotalAreEqual(){
    if (error_div == null) error_div = document.getElementById('error').firstChild;
    if (submit_button == null) submit_button = document.getElementById('submit-btn')

    if (total_offerings != total_denominations){
        error_div.style.display = "block"
        submit_button.disabled = true;
        submit_button.classList.add("button-error")
    }else {
        error_div.style.display = "none"
        submit_button.disabled = false;
        submit_button.classList.remove("button-error")
    }
}


