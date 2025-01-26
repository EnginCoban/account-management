let form = document.getElementById("form");

function validateForm(username, password, email, emailRegex) {
    if (username.trim().length === 0 || password.trim().length === 0 || email.trim().length === 0) {
        alert("Bitte Füllen Sie alle Felder aus!");
        return false;
    } else if (!emailRegex.test(email)) {
        alert("Falsches Email-Format!");
        return false;
    } else {
        return true;
    }
}

form.addEventListener('submit', function(event) {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let email = document.getElementById("email").value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let isFormValid = validateForm(username, password, email, emailRegex);
    if (!isFormValid) {
        event.preventDefault();
    }

});