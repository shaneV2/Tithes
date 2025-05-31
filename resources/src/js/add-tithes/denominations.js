import checkIfTotalOfferingsAndDenominationsTotalAreEqual from "./checkUserInputs.js"

let total_denominations = 0
export {total_denominations}

document.addEventListener("DOMContentLoaded", ()=> {
    const thousands_input = document.getElementById("1000")
    const five_hundreds_input = document.getElementById("500")
    const two_hundreds_input = document.getElementById("200")
    const hundreds_input = document.getElementById("100")
    const fifties_input = document.getElementById("50")
    const twenties_input = document.getElementById("20")
    const tens_input = document.getElementById("10")
    const fives_input = document.getElementById("5")
    const ones_input = document.getElementById("1")

    const inputs = [thousands_input, five_hundreds_input, two_hundreds_input, hundreds_input, fifties_input, twenties_input, tens_input, fives_input, ones_input]
    inputs.forEach((input) => {
        input.addEventListener("change", handleDenominationChange)
    })

    let thousands = 0
    let five_hundreds = 0
    let two_hundreds = 0
    let hundreds = 0
    let fifties = 0
    let twenties = 0
    let tens = 0
    let fives = 0
    let ones = 0
    function handleDenominationChange(e){
        const input_id = e.target.id 
        const value = parseFloat(e.target.value) || 0
        
        switch (input_id){
            case '1000':
                thousands = value * 1000
                break
            case '500':
                five_hundreds = value * 500
                break
            case '200':
                two_hundreds = value * 200
                break
            case '100':
                hundreds = value * 100
                break
            case '50':
                fifties = value * 50
                break
            case '20':
                twenties = value * 20
                break
            case '10':
                tens = value * 10
                break
            case '5':
                fives = value * 5
                break
            case '1':
                ones = value * 1
                break
        }

        total_denominations = thousands + five_hundreds + two_hundreds + hundreds + fifties + twenties + tens + fives + ones

        checkIfTotalOfferingsAndDenominationsTotalAreEqual()
    }
})