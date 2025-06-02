export default function checkIfFilterEnabled(){
    const params = new URLSearchParams(window.location.search)

    if (params.has("filter") == true) {
        return true
    }else {
        return false
    }
}

export function setMonthAndYearFilterFromURL(){
    const month = document.getElementById("month")
    const year = document.getElementById("year")

    const params = new URLSearchParams(window.location.search)
    month.value = params.get("month")
    year.value = params.get("year")
}