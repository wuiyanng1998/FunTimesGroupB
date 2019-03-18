var check = function () {
    let errorContainer = document.getElementById("passwordError");
    if (document.getElementById('password').value !=
        document.getElementById('passwordConfirm').value) {
        errorContainer.innerHTML = "<p class='text-warning'> Your password does not match</p>";
    }else {
        errorContainer.innerHTML = "";
    }
};