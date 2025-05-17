import checkIfTotalOfferingsAndDenominationsTotalAreEqual from "./checkUserInputs.js"

let total_offerings = 0;
export {total_offerings}

document.addEventListener("DOMContentLoaded", () => {
    const tithes_input = document.getElementById("tithes");
    const mission_input = document.getElementById("mission");
    const omg_input = document.getElementById("omg");
    const pledges_input = document.getElementById("pledges");
    const donation_input = document.getElementById("donation");
    const total_div = document.getElementById('total')

    const inputs = [tithes_input, mission_input, omg_input, pledges_input, donation_input]
    inputs.forEach((input) => {
        input.addEventListener("change", handleOfferingChange)
    })
    
    let tithes = 0
    let mission = 0
    let omg = 0
    let pledges = 0
    let donation = 0
    function handleOfferingChange(e){
        const input_id = e.target.id 
        const value = parseFloat(e.target.value) || 0
        
        switch (input_id){
            case 'tithes':
                tithes = value
                break
            case 'mission':
                mission = value
                break
            case 'omg':
                omg = value
                break
            case 'pledges':
                pledges = value
                break
            case 'donation':
                donation = value
                break
        }

        total_offerings = tithes + mission + omg + pledges + donation;
        total_div.innerHTML = total_offerings

        checkIfTotalOfferingsAndDenominationsTotalAreEqual()
    }

})
