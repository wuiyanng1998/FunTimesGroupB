let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

let monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);

}

function showCalendar(month, year) {

    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                let cell = document.createElement("td");
                let cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("bg-primary-light");
                } // color today's date
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }
        }
        tbl.appendChild(row); // appending each row into calendar body.
    }
    getSelectedDate(month, year);

}


function getSelectedDate(month, year) {
    let calendarBody = document.getElementById("calendar-body");
    if (calendarBody != null) {
        for (let i = 0; i < calendarBody.rows.length; i++) {
            for (let j = 0; j < calendarBody.rows[i].cells.length; j++) {
                calendarBody.rows[i].cells[j].onclick = function () {
                    removeActiveCells();
                    getValue(this, month, year);
                    selectedDayTabAJAX();
                };
            }
        }

    }

    function getValue(cel, month, year) {
        month = month + 1;
        if (month < 10) {
            let zeroMonth = '0' + month;
            month = zeroMonth;
        }
        $("#selected_day").val(cel.innerHTML);
        $("#selected_year").val(year);
        $("#selected_month").val(month);

        // alert(cel.innerHTML + "-" + month + "-" + year);
        cel.classList.add("bg-primary");
    }

    function removeActiveCells() {
        for (let i = 0; i < calendarBody.rows.length; i++) {
            for (let j = 0; j < calendarBody.rows[i].cells.length; j++) {
                calendarBody.rows[i].cells[j].classList.remove("bg-primary");
            }
        }
    }
}

