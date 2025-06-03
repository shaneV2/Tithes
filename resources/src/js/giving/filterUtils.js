export default function checkIfFilterEnabled(){
    const month_value = document.getElementById("month").value
    const year_value = document.getElementById("year").value

    if (month_value && year_value){
        return true
    }else {
        return false
    }
}