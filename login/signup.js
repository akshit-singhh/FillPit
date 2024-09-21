document.getElementById('password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('password-error');
    const progressBar = document.getElementById('progress-status');

    // Regex for password validation
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

    // Check password strength
    if (!passwordRegex.test(password)) {
        passwordError.textContent = 'Password must be at least 8 characters, and include a letter, number, and special character.';
        progressBar.style.width = '20%'; // Weak progress
        progressBar.parentElement.style.backgroundColor = '#f44336'; // Red
    } else {
        passwordError.textContent = ''; // Clear error message
        progressBar.style.width = '100%'; // Full progress
        progressBar.parentElement.style.backgroundColor = '#4CAF50'; // Green
    }
});

document.getElementById('submit-btn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission for validation

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const passwordError = document.getElementById('password-error');

    // Check if any fields are empty
    if (!email || !password || !confirmPassword) {
        alert('All fields are required.');
        return;
    }

    // Confirm password match
    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    // If all validations pass
    alert('Signup successful!');
    // Submit the form here if needed
    // document.querySelector('form').submit();
});

