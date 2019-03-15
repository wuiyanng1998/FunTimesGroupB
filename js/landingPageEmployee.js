function historyTabAJAX() {
    //Retrieve information
    var q = $("#bookerId").val();

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
            console.log("worked pending to HTML");
        }
        $("#history_tab").attr("class", "nav-link active");
        $("#upcoming_tab").attr("class", "nav-link text-primary");
    }
}


function upcomingTabAJAX() {
    //Retrieve information
    var q = $("#bookerId").val();

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
        $("#history_tab").attr("class", "nav-link text-primary");

    }
}