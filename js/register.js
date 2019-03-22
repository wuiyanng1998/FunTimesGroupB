let checkPasswordConfirm = function () {
    let errorContainer = document.getElementById("passwordConfirmError");
    errorContainer.innerHTML = "";
    if (document.getElementById('password').value !=
        document.getElementById('passwordConfirm').value) {
        errorContainer.innerHTML += "<p class='text-warning'> Your password does not match.</p>";
        return false
    } else {
        errorContainer.innerHTML = "";
        return true
    }
};

let checkPasswordInput = function () {
    let errorContainer = document.getElementById("passwordError");
    errorContainer.innerHTML = "";
    if (!checkPassword()) {
        errorContainer.innerHTML += "<p class='text-warning'> Your password should be at least 8 characters and must contain at least 1 uppercase letter, 1 lowercase letter, and 1 number.</p>";
        return false
    } else {
        errorContainer.innerHTML = "";
        return true
    }
};


function checkPassword() {
    let password = $("#password").val();
    let re = new RegExp("^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$");
    console.log(re.test(password));
    return (re.test(password));
}


let checkFirstName = function () {
    let errorContainer = document.getElementById("firstNameError");
    let input = document.getElementById('firstName').value;
    let re = new RegExp("[A-Z][a-z]*$");
    if (re.test(input)) {
        errorContainer.innerHTML = "";
        return true
    } else {
        errorContainer.innerHTML = "<p class='text-warning'> First name should start with a capital letter and only contain letters</p>";
        return false
    }
};

let checkLastName = function () {
    let errorContainer = document.getElementById("lastNameError");
    let input = document.getElementById('lastName').value;
    let re = new RegExp("[A-Z][a-z]*$");
    if (re.test(input)) {
        errorContainer.innerHTML = "";
        return true
    } else {
        errorContainer.innerHTML = "<p class='text-warning'> First name should start with a capital letter and only contain letters</p>";
        return false
    }
};


let checkPhoneNumber = function () {
    let errorContainer = document.getElementById("phoneNumberError");
    let input = document.getElementById('phoneNumber').value;
    let re = new RegExp("[0-9]*$");
    if (re.test(input) && input.length == 11) {
        errorContainer.innerHTML = "";
        return true
    } else {
        errorContainer.innerHTML = "<p class='text-warning'> Phone number must be made of 11 digits</p>";
        return false
    }
};


let checkEmail = function () {
    let errorContainer = document.getElementById("emailError");
    let input = document.getElementById('email').value;
    let re = new RegExp("^(?:(?:[\\w`~!#$%^&*\\-=+;:{}'|,?\\/]+(?:(?:\\.(?:\"(?:\\\\?[\\w`~!#$%^&*\\-=+;:{}'|,?\\/\\.()<>\\[\\] @]|\\\\\"|\\\\\\\\)*\"|[\\w`~!#$%^&*\\-=+;:{}'|,?\\/]+))*\\.[\\w`~!#$%^&*\\-=+;:{}'|,?\\/]+)?)|(?:\"(?:\\\\?[\\w`~!#$%^&*\\-=+;:{}'|,?\\/\\.()<>\\[\\] @]|\\\\\"|\\\\\\\\)+\"))@(?:[a-zA-Z\\d\\-]+(?:\\.[a-zA-Z\\d\\-]+)*|\\[\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\])$");
    if (re.test(input)) {
        errorContainer.innerHTML = "";
        return true
    } else {
        errorContainer.innerHTML = "<p class='text-warning'> Enter valid email</p>";
        return false
    }
};


function verifyInputs() {
    let verified = checkPassword() && checkPasswordConfirm() && checkFirstName() && checkLastName() && checkPhoneNumber();
    return (verified);
}
