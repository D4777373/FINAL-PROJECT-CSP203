document.addEventListener("DOMContentLoaded", function() {
    // Get the form and form elements
    const loginForm = document.getElementById('loginForm');
    const usernameField = document.getElementById('username');
    const passwordField = document.getElementById('password');
    const loginButton = document.getElementById('loginBtn');

    // Listen for form submission
    loginForm.addEventListener('submit', function(event) {
        // Clear previous error messages
        clearErrors();

        // Validate form fields
        let valid = true;

        // Check if username is empty
        if (usernameField.value.trim() === '') {
            displayError('Username is required.');
            valid = false;
        }

        // Check if password is empty
        if (passwordField.value.trim() === '') {
            displayError('Password is required.');
            valid = false;
        }

        // If any field is invalid, prevent form submission
        if (!valid) {
            event.preventDefault();
        }
    });

    // Function to display error messages
    function displayError(message) {
        const errorMessageElement = document.createElement('p');
        errorMessageElement.classList.add('error-message');
        errorMessageElement.textContent = message;
        loginForm.appendChild(errorMessageElement);
    }

    // Function to clear previous error messages
    function clearErrors() {
        const errorMessages = loginForm.querySelectorAll('.error-message');
        errorMessages.forEach(function(error) {
            error.remove();
        });
    }
});
