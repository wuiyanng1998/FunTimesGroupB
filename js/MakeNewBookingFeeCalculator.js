carCosts = [];

function calculateFee(travelTime) {
    if (travelTime > 0) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let carCostsJSON = this.response;
                let carCosts = JSON.parse(carCostsJSON);

                console.log(carCosts.content);
            }
        };
        xmlhttp.open("GET", "MakeNewBookingCarCost.php?q=" + travelTime, true);
        xmlhttp.send();
    } else {

    }
}

