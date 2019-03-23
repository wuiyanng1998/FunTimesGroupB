function historyTabAJAX() {
    //Retrieve information
    var q = $("#driverId").val();

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/landingPageDriverAJAXHistoryTab.php?q=' + q, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("worked pending AJAX");
            let result = xhr.responseText;
            let bookingList = JSON.parse(result);
            console.log(bookingList);
            addHistoryTabToHTML(bookingList);
        }
    };
    xhr.send();
}

function addHistoryTabToHTML(bookingList) {
    //leave relevant cars in the order of the html elements
    if (typeof bookingList === "undefined") {
        console.log("undefined");
    } else {
        $("#myBookingTable").empty();
        for (let i = 0; i < bookingList.length; i++) {
            let historyTable = `<td class="p-2">` + bookingList[i][0][0] + ` </td>
            <td class="p-2">` + bookingList[i][0][1] + `</td>
            <td class="p-2">` + bookingList[i][0][2] + `</td>
            <td class="p-2">` + bookingList[i][0][3] + `</td>
            <td class="p-2">` + bookingList[i][0][4] + `</td>
            <td class="p-2">` + bookingList[i][0][5] + `</td>`;
            console.log(historyTable);
            document.getElementById("myBookingTable").innerHTML += historyTable;
            console.log("worked historyTab to HTML");
        }

        $("#history").attr("class", "nav-link active");
        $("#upcoming_tab").attr("class", "nav-link text-primary");
        $("#selectedDay").attr("class", "nav-link text-primary");
    }
}


function upcomingTabAJAX() {
    //Retrieve information
    var q = $("#driverId").val();

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/landingPageDriverAJAXUpcomingTab.php?q=' + q, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("worked pending AJAX");
            let result = xhr.responseText;
            let bookingList = JSON.parse(result);
            console.log(bookingList);
            addUpcomingTabToHTML(bookingList);
        }
    };
    xhr.send();
}

function addUpcomingTabToHTML(bookingList) {
    //leave relevant cars in the order of the html elements
    if (typeof bookingList === "undefined") {
        console.log("undefined");
    } else {

        $("#myBookingTable").empty();
        for (let i = 0; i < bookingList.length; i++) {
            let historyTable = `<td class="p-2">` + bookingList[i][0][0] + ` </td>
            <td class="p-2">` + bookingList[i][0][1] + `</td>
            <td class="p-2">` + bookingList[i][0][2] + `</td>
            <td class="p-2">` + bookingList[i][0][3] + `</td>
            <td class="p-2">` + bookingList[i][0][4] + `</td>
            <td class="p-2">` + bookingList[i][0][5] + `</td>`;
            console.log(historyTable);
            document.getElementById("myBookingTable").innerHTML += historyTable;
            console.log("worked pending to HTML");
        }

        $("#upcoming_tab").attr("class", "nav-link active");
        $("#history").attr("class", "nav-link text-primary");
        $("#selectedDay").attr("class", "nav-link text-primary");

    }
}


function selectedDayTabAJAX() {
    //Retrieve information
    let q = $("#driverId").val();

    let day = $("#selected_day").val();
    let month = $("#selected_month").val();
    let year = $("#selected_year").val();

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/landingPageDriverAJAXSelectedDate.php?q=' + q + "&day=" + day + "&month="
        + month + "&year=" +year, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("worked pending AJAX");
            let result = xhr.responseText;
            let bookingList = JSON.parse(result);
            addSelectedDayTabToHTML(bookingList, day, month, year);
        }
    };
    xhr.send();
}

function addSelectedDayTabToHTML(bookingList, day, month, year) {
    //leave relevant cars in the order of the html elements
    if (typeof bookingList === "undefined") {
        console.log("undefined");
    } else {

        $("#myBookingTable").empty();
        for (let i = 0; i < bookingList.length; i++) {
            let historyTable = `<td class="p-2">` + bookingList[i][0][0] + ` </td>
            <td class="p-2">` + bookingList[i][0][1] + `</td>
            <td class="p-2">` + bookingList[i][0][2] + `</td>
            <td class="p-2">` + bookingList[i][0][3] + `</td>
            <td class="p-2">` + bookingList[i][0][4] + `</td>
            <td class="p-2">` + bookingList[i][0][5] + `</td>`;
            console.log(historyTable);
            document.getElementById("myBookingTable").innerHTML += historyTable;
            console.log("worked selectedDay to HTML");
        }


        $("#selectedDay").text("Trips on " + day + "." + month + "." + year);
        $("#selectedDay").attr("class", "nav-link active");
        $("#history").attr("class", "nav-link text-primary");
        $("#upcoming_tab").attr("class", "nav-link text-primary");
    }
}
