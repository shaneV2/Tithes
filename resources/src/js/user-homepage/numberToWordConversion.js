var ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
var tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
var teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

function convert_millions(num) {
    if (num >= 1000000) {
        return convert_millions(Math.floor(num / 1000000)) + " Million " + convert_thousands(num % 1000000);
    } else {
        return convert_thousands(num);
    }
}

function convert_thousands(num) {
    if (num >= 1000) {
        return convert_hundreds(Math.floor(num / 1000)) + " Thousand " + convert_hundreds(num % 1000);
    } else {
        return convert_hundreds(num);
    }
}

function convert_hundreds(num) {
    if (num > 99) {
        return ones[Math.floor(num / 100)] + " Hundred " + convert_tens(num % 100);
    } else {
        return convert_tens(num);
    }
}

function convert_tens(num) {
    if (num < 10) return ones[num];
    else if (num >= 10 && num < 20) return teens[num - 10];
    else {
        return tens[Math.floor(num / 10)] + " " + ones[num % 10];
    }
}

export default function numberToWordConversion(num) {
    const amount = String(num).split('.')
    const whole_number = amount[0]
    const decimal_number = amount[1] 

    if (num == 0) return "zero";
    else return convert_millions(whole_number) + " Pesos and " + convert_millions(decimal_number) + "Cents";
}