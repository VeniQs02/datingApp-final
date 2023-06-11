function showUserPassword() {
    let passwordInput = document.getElementById("userPassword");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}