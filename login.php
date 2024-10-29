<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Cart / Login</title>
    <link rel="stylesheet" href="styles_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        .fb-login-button{
            border-radius: 3px;
            width: 215px;
            font-size: 11px;
            height: 40px;
            background-color: rgb(26, 119, 242);
            color: rgb(255, 255, 255);
            border: 0px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .no-underline{
            text-decoration: none !important;
        }
    </style>

    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];w[l].push({
                'gtm.start':
                    new Date().getTime(),event:'gtm.js'
            }); var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KPF2H97H');
    </script>
    <!-- End Google Tag Manager -->

</head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v20.0" nonce="A9q6d3Jb"></script>
        <div class="main-content">
            <div class="logo">
                <h1><i class="fas fa-store"></i> Smart Cart</h1>
            </div>
            <div class="auth-container">
                <div class="auth-form">
                    <div class="auth-toggle">
                        <button id="loginBtn" class="active">Login</button>
                        <button id="signupBtn">Sign Up</button>
                    </div>
                    <form method="POST" action="register.php" id="loginForm" class="active">
                        <h2>Login</h2>
                        <div class="input-group">
                            <label for="loginEmail">Email <i class="fa fa-envelope" aria-hidden="true"></i></label>
                            <input type="email" id="loginEmail" name = "Email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-group password-group">
                            <label for="loginPassword">Password <i class="fa fa-lock" aria-hidden="true"></i></label>
                            <input type="password" id="loginPassword" name = "Password" placeholder="Enter your password" required>
                            <span class="toggle-password">
                                <i class="fas fa-eye" id="toggleLoginPassword"></i>
                            </span>
                        </div>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                        <button type="submit" class="auth-btn" name = "signIn">Login</button>
                        <p class="or">--------or--------</p>
                        <div class="icons">
                            <div id="g_id_onload"
                                data-client_id="450726384001-l075m6t166ijfc1mb5ufhnppklni8su0.apps.googleusercontent.com"
                                data-callback="handleCredentialResponse">
                            </div>
                            <div class="g_id_signin" data-type="standard"></div>
                            <a href="facebook_login.php" class="no-underline"><div class="fb-login-button" data-width="" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"></div></a>
                        </div>                
                        <p class="auth-link">Don't have an account? <a href="#" id="switchToSignup">Sign up</a></p>
                    </form>
                    <form method="POST" action="register.php" id="signupForm">
                        <h2>Sign Up</h2>
                        <div class="input-group">
                            <label for="signupUsername">Username <i class="fa fa-user" aria-hidden="true"></i></label>
                            <input type="text" id="signupUsername" name = "Username" placeholder="Enter your username" required>
                        </div>
                        <div class="input-group">
                            <label for="signupEmail">Email <i class="fa fa-envelope" aria-hidden="true"></i></label>
                            <input type="email" id="signupEmail" name = "Email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-group password-group">
                            <label for="signupPassword">Password <i class="fa fa-lock" aria-hidden="true"></i></label>
                            <input type="password" id="signupPassword" name = "Password" placeholder="Enter your password" required>
                            <span class="toggle-password">
                                <i class="fas fa-eye" id="toggleSignupPassword"></i>
                            </span>
                        </div>
                        <div class="input-group password-group">
                            <label for="signupConfirmPassword">Confirm Password <i class="fa fa-lock" aria-hidden="true"></i></label>
                            <input type="password" id="signupConfirmPassword" name="ConfirmPassword" placeholder="Confirm your password" required>
                            <span class="toggle-password">
                                <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                            </span>
                        </div>
                        <button type="submit" class="auth-btn" name = "signUp">Sign Up</button>
                        <p class="or">--------or--------</p>
                        <div class="icons">
                            <div id="g_id_onload"
                                data-client_id="450726384001-l075m6t166ijfc1mb5ufhnppklni8su0.apps.googleusercontent.com"
                                data-callback="handleCredentialResponse">
                            </div>
                            <div class="g_id_signin" data-type="standard"></div>
                            <a href="facebook_login.php" class="no-underline"><div class="fb-login-button" data-width="100" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"></div></a>
                        </div>  
                        <p class="auth-link">Already have an account? <a href="#" id="switchToLogin">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <p>&copy; 2024 Smart Cart. All rights reserved.</p>
        </footer>
        <script src="scripts.js"></script>
        <script>
            function handleCredentialResponse(response) {
                console.log("Encoded JWT ID token: " + response.credential);
                
                // Send the token to the PHP backend for verification
                fetch('verify.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ token: response.credential })
                })
                .then(res => res.json())
                .then(data => {
                if (data.success) {
                    // Redirect to a logged-in page or show success message
                    window.location.href = 'homepage.php';
                    console.log("User authenticated!");
                } else {
                    console.error("Authentication failed");
                }
                })
                .catch(error => {
                console.error("Error during token verification", error);
                });
            }
        </script>

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KPF2H97H"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->  

    </body>
</html>
