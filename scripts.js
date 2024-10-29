/* Login / Sign up */
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    const loginBtn = document.getElementById('loginBtn');
    const signupBtn = document.getElementById('signupBtn');
    const switchToSignup = document.getElementById('switchToSignup');
    const switchToLogin = document.getElementById('switchToLogin');

    loginBtn.addEventListener('click', () => {
        loginForm.classList.add('active');
        signupForm.classList.remove('active');
        loginBtn.classList.add('active');
        signupBtn.classList.remove('active');
    });

    signupBtn.addEventListener('click', () => {
        signupForm.classList.add('active');
        loginForm.classList.remove('active');
        signupBtn.classList.add('active');
        loginBtn.classList.remove('active');
    });

    switchToSignup.addEventListener('click', (e) => {
        e.preventDefault();
        signupForm.classList.add('active');
        loginForm.classList.remove('active');
        signupBtn.classList.add('active');
        loginBtn.classList.remove('active');
    });

    switchToLogin.addEventListener('click', (e) => {
        e.preventDefault();
        loginForm.classList.add('active');
        signupForm.classList.remove('active');
        loginBtn.classList.add('active');
        signupBtn.classList.remove('active');
    });

    const toggleLoginPassword = document.getElementById('toggleLoginPassword');
    const toggleSignupPassword = document.getElementById('toggleSignupPassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

    toggleLoginPassword.addEventListener('click', () => {
        const passwordField = document.getElementById('loginPassword');
        togglePasswordVisibility(passwordField, toggleLoginPassword);
    });

    toggleSignupPassword.addEventListener('click', () => {
        const passwordField = document.getElementById('signupPassword');
        togglePasswordVisibility(passwordField, toggleSignupPassword);
    });

    toggleConfirmPassword.addEventListener('click', () => {
        const passwordField = document.getElementById('signupConfirmPassword');
        togglePasswordVisibility(passwordField, toggleConfirmPassword);
    });

    // Toggle password visibility
    function togglePasswordVisibility(passwordField, toggleIcon) {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
});

/* Contact Form Submission*/
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Collect form data
    const formData = new FormData(this);

    // Send an AJAX request
    fetch('submit_contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            alert('Thank you for your message! We will get back to you soon.');
            document.getElementById('contactForm').reset(); // Reset the form
        } else {
            alert('There was an error submitting your message: ' + data);
        }
    })
    .catch(error => {
        alert('An error occurred: ' + error.message);
    });
});

/* Scroll to Top functionality */
let scrollToTopBtn = document.getElementById("scrollToTopBtn");

// Function to toggle scroll button visibility
function toggleScrollToTopBtn() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

// Attach scroll event listener
window.addEventListener('scroll', toggleScrollToTopBtn);

// When the user clicks on the button, scroll to the top of the document
scrollToTopBtn.addEventListener('click', function(event) {
    event.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

/* Predict Now */

    // Get the modal
    var modal = document.getElementById("predictionModal");

    // Get the button that opens the modal
    var btn = document.getElementById("predictBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Function to close modal
    function closeModal() {
        modal.style.display = "none";
        window.removeEventListener('scroll', onScrollCloseModal);
    }

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
        window.addEventListener('scroll', onScrollCloseModal);
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        closeModal();
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
    
    // Function to handle scroll event and close modal
    function onScrollCloseModal() {
        closeModal();
    }