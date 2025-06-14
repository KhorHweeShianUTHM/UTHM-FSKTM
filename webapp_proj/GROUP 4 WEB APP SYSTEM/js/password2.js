function checkPassword() {
    var password = document.getElementById('passwordInput').value;
    var confirmPassword = document.getElementById('confirmpasswordInput').value;
    var message = document.getElementById('message');

    if (password !== confirmPassword) {
        message.style.display = 'block';
    } else {
        message.style.display = 'none'; // Hide error message if passwords match
        document.getElementById('registrationForm').submit(); // Submit the form if passwords match
    }
}