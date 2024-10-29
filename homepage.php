<?php
session_start();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include("connect.php");

// Regenerate session ID to prevent session fixation
if (!isset($_SESSION['regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['regenerated'] = true;
}

// Check if user is logged in either through regular login or Google Sign-In
if (!isset($_SESSION['Email']) && !isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCart / Homepage</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <script>
        function confirmLogout() {
            var confirmation = confirm("Are you sure you want to logout?");
            if (confirmation) {
                // This part logs the user out from their Google account
                google.accounts.id.disableAutoSelect();
                // Clear the session on your front-end as well
                localStorage.removeItem('google_login_token');
                window.location.href = "logout.php";
            }
        }
    </script>
    
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
    <header>
        <div class="container">
            <h1><i class="fas fa-store"></i> Smart Cart</h1>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#team">Team</a></li>
                    <!-- Dropdown Menu -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropbtn">Prediction & Recommendations</a>
                        <div class="dropdown-content">
                            <a href="prediction.php">K-Means Clustering <br> Model</a>
                            <a href="prediction2.php">Hierarchical Clustering Model</a>
                        </div>
                    </li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="admin-dashboard.php">Dashboard</a></li>
                    <li><a href="javascript:void(0);" onclick="confirmLogout();"><button class="logout-btn">Logout</button></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="container">
            <div class="greeting" style="text-align:center;">
                <p style = "font-size:50px;">
                 Welcome,  <?php 
                if(isset($_SESSION['Email'])){
                    $Email=$_SESSION['Email'];
                    $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.Email='$Email'");
                    while($row=mysqli_fetch_array($query)){
                    echo $row['Username'];
                    }
                }
                if(isset($_SESSION['userid'])){
                    $userid=$_SESSION['userid'];
                    $query=mysqli_query($conn, "SELECT google_users.* FROM `google_users` WHERE google_users.google_id='$userid'");
                    while($row=mysqli_fetch_array($query)){
                    echo $row['nameFromEmail'];
                    }
                }
                if(isset($_SESSION['userid'])){
                    $fuserid=$_SESSION['userid'];
                    $query=mysqli_query($conn, "SELECT facebook_users.* FROM `facebook_users` WHERE facebook_users.facebook_id='$userid'");
                    while($row=mysqli_fetch_array($query)){
                    echo $row['name'];
                    }
                }
                ?>
                :)
                </p>
            </div>
            <h2>Maximize Sales with Data-Driven Insights</h2>
            <p>Predict future sales trends and offer personalized product recommendations to your customers.</p>
            <a class="btn" id="predictBtn">Predict Now</a>
            <!-- The Modal -->
            <div id="predictionModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Select Model</h2>
                    <div class="button-container">
                        <button class="modal-button" onclick="window.location.href='prediction.php'">K-Means Clustering Model</button>
                        <button class="modal-button" onclick="window.location.href='prediction2.php'">Hierarchical Clustering Model</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <h2>About Our Service</h2>
            <p>Our platform leverages advanced machine learning algorithms to provide accurate sales predictions and personalized product recommendations. By analyzing past sales data, we help supermarkets make informed decisions that boost sales and customer satisfaction.</p>
            <div class="features">
                <div class="feature-box">
                    <i class="fas fa-chart-line"></i>
                    <h3>Sales Prediction</h3>
                    <p>Accurately forecast future sales based on historical data and trends.</p>
                </div>
                <div class="feature-box">
                    <i class="fas fa-thumbs-up"></i>
                    <h3>Product Recommendations</h3>
                    <p>Offer personalized product suggestions to your customers based on their buying habits.</p>
                </div>
                <div class="feature-box">
                    <i class="fas fa-users"></i>
                    <h3>Customer Insights</h3>
                    <p>Understand your customers better and tailor your offerings to meet their needs.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team">
        <div class="container">
            <h2>Meet Our Team</h2>
            <p>Our team consists of dedicated professionals who are passionate about helping supermarkets optimize their sales and improve customer satisfaction.</p>
            <div class="team-members">
                <div class="team-member">
                    <img src="Assets/Images/ved.jpg" alt="Team Member 1">
                    <h3>Ved Shirur</h3>
                    <p>Data Scientist - Specializes in machine learning and predictive analytics.</p>
                    <p> <i class="fa fa-envelope" aria-hidden="true"></i> 2022.ved.shirur@ves.ac.in</p>
                    <div class="socials">
                        <a href="https://www.linkedin.com/in/johndoe" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/johndoe" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://facebook.com/johndoe" target="_blank" title="Facebook Profile"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="team-member">
                    <img src="Assets/Images/sunset.jpg" alt="Team Member 2">
                    <h3>Honey Kundla</h3>
                    <p>Product Manager - Expert in product recommendations and user experience.</p>
                    <p> <i class="fa fa-envelope" aria-hidden="true"></i> d2022.honey.kundla@ves.ac.in</p>
                    <div class="socials">
                        <a href="https://www.linkedin.com/in/johndoe" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/johndoe" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://facebook.com/johndoe" target="_blank" title="Facebook Profile"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="team-member">
                    <img src="Assets/Images/aditya.jpg" alt="Team Member 3">
                    <h3>Aditya Joshi</h3>
                    <p>Software Engineer - Focuses on system integration and performance optimization.</p>
                    <p> <i class="fa fa-envelope" aria-hidden="true"></i> 2022.aditya.joshi@ves.ac.in</p>
                    <div class="socials">
                        <a href="https://www.linkedin.com/in/johndoe" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/johndoe" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://facebook.com/johndoe" target="_blank" title="Facebook Profile"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Have any questions or need help? Feel free to reach out to us!</p>
            <form id="contactForm" action="submit_contact.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Smart Cart. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scroll to Top Icon -->
    <a href="#" id="scrollToTopBtn"><i class="fas fa-chevron-up"></i></a>

    <script src="scripts.js"></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KPF2H97H"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->  

</body>

</html>
