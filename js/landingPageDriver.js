function historyTabAJAX() {
    //Retrieve information
    var q = $("#driverId").val();

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/landingPageEmployeeAJAXHistoryTab.php?q=' + q, true);
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
            let historyTable = `<td class="p-2">` + bookingList[i][0] + `</td>
            <td class="p-2">` + bookingList[i][1] + `</td>
            <td class="p-2">` + bookingList[i][2] + `</td>
            <td class="p-2">` + bookingList[i][3] + `</td>
            <td class="p-2">` + bookingList[i][4] + `</td>
            <td class="p-2">£` + bookingList[i][5] + `</td>`
            console.log(historyTable);
            $("#myBookingTable").html(historyTable);
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
    xhr.open('GET', 'php/landingPageEmployeeAJAXUpcomingTab.php?q=' + q, true);
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
            let historyTable = `<td class="p-2">` + bookingList[i][0] + ` </td>
            <td class="p-2">` + bookingList[i][1] + `</td>
            <td class="p-2">` + bookingList[i][2] + `</td>
            <td class="p-2">` + bookingList[i][3] + `</td>
            <td class="p-2">` + bookingList[i][4] + `</td>
            <td class="p-2">£` + bookingList[i][5] + `</td>`;
            console.log(historyTable);
            $("#myBookingTable").html(historyTable);
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
    let date = $("#selected_date").val();

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/landingPageEmployeeAJAXUpcomingTab.php?q=' + q + "&date=" + date, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("worked pending AJAX");
            let result = xhr.responseText;
            let bookingList = JSON.parse(result);
            console.log(bookingList);
            addSelectedDayTabToHTML(bookingList, date);
        }
    };
    xhr.send();
}

function addSelectedDayTabToHTML(bookingList, date) {
    //leave relevant cars in the order of the html elements
    if (typeof bookingList === "undefined") {
        console.log("undefined");
    } else {
        $("#myBookingTable").empty();
        for (let i = 0; i < bookingList.length; i++) {
            let historyTable = `<td class="p-2">` + bookingList[i][0] + ` </td>
            <td class="p-2">` + bookingList[i][1] + `</td>
            <td class="p-2">` + bookingList[i][2] + `</td>
            <td class="p-2">` + bookingList[i][3] + `</td>
            <td class="p-2">` + bookingList[i][4] + `</td>
            <td class="p-2">£` + bookingList[i][5] + `</td>`;
            console.log(historyTable);
            $("#myBookingTable").html(historyTable);
            console.log("worked selectedDay to HTML");
        }

        let dateArray = date.split("-");
        let year = dateArray[0];
        let month = dateArray[1];
        let day = dateArray[2];


        $("#selectedDay").text("Trips on " + day + "." + month + "." + year);
        $("#selectedDay").attr("class", "nav-link active");
        $("#history").attr("class", "nav-link text-primary");
        $("#upcoming_tab").attr("class", "nav-link text-primary");
    }
}
