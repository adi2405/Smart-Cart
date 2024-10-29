<?php 

include 'connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($Email, $v_code)
{
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'adityajoshi0524@gmail.com';                     //SMTP username
        $mail->Password   = 'nlcx mgbx lyvz dnmp';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('adityajoshi0524@gmail.com', 'Smart Cart');
        $mail->addAddress($Email);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification for Smart Cart Account';
        $mail->Body = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    font-family: 'Roboto', sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border: 1px solid #dddddd;
                    border-radius: 8px;
                    padding: 20px;
                }
                .header {
                    background-color: #4CAF50;
                    color: #ffffff;
                    text-align: center;
                    padding: 10px 0;
                    border-radius: 8px 8px 0 0;
                }
                .header h1 {
                    margin: 0;
                }
                .content {
                    margin: 20px 0;
                    text-align: center;
                }
                .content h2 {
                    color: #333333;
                }
                .content p {
                    color: #555555;
                    font-size: 16px;
                    line-height: 1.5;
                }
                .verify-btn {
                    display: inline-block;
                    background-color: #4CAF50;
                    color: #ffffff !important;
                    text-decoration: none;
                    padding: 12px 0;
                    width: 150px;
                    border-radius: 5px;
                    font-size: 16px;
                    text-align: center;
                    line-height: 1.2;
                    font-weight: 600;
                }
                .verify-btn:hover {
                    background-color: #45a049;
                }
                .footer {
                    margin-top: 30px;
                    font-size: 12px;
                    color: #888888;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Welcome to Smart Cart</h1>
                </div>
                <div class='content'>
                    <h2>Thank you for registering!</h2>
                    <p>We are excited to have you on board. Please verify your email address by clicking the button below to activate your account.</p>
                    <a href='http://localhost/smart%20cart/email_verification.php?email=$Email&v_code=$v_code' class='verify-btn'>Verify Email</a>
                </div>
                <div class='footer'>
                    <p>If you did not create an account, you can safely ignore this email.</p>
                </div>
            </div>
        </body>
        </html>";
            
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['signUp'])){
    $Username = isset($_POST['Username']) ? $conn->real_escape_string($_POST['Username']) : '';
    $Email = isset($_POST['Email']) ? $conn->real_escape_string($_POST['Email']) : '';
    $Password = isset($_POST['Password']) ? $conn->real_escape_string($_POST['Password']) : '';
    $ConfirmPassword = isset($_POST['ConfirmPassword']) ? $conn->real_escape_string($_POST['ConfirmPassword']) : '';
    $v_code = bin2hex(random_bytes(16));

    if($Password !== $ConfirmPassword){
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    $Password = md5($Password);

    $checkEmail = "SELECT * FROM users WHERE Email='$Email'";
    $result = $conn->query($checkEmail);

    if($result->num_rows > 0){
        echo "<script>alert('Email Already Exists!'); window.history.back();</script>";
    } else {
        $insertQuery = "INSERT INTO users (Username, Email, Password, verification_code, is_verified) VALUES ('$Username', '$Email', '$Password', '$v_code', '0')";
        if($conn->query($insertQuery) === TRUE && sendMail($_POST['Email'], $v_code)){
            echo "<script>alert('Registration successful! A verification link has been sent to your email. Please check your inbox and verify your email address before logging in.'); window.location.href='login.php';</script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if(isset($_POST['signIn'])){
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Password = md5($Password);
    
    $sql = "SELECT * FROM users WHERE Email='$Email' AND Password='$Password'";
    $result = $conn->query($sql);
 
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        // Check if the user has verified their email
        if ($row['is_verified'] == 1) {
            session_start();
            $_SESSION['Email'] = $row['Email'];
            header("Location: homepage.php");
            exit();
        } else {
            echo "<script>alert('Please verify your email first!'); window.history.back();</script>";
        }
   } else {
        echo "<script>alert('Incorrect Email or Password!'); window.history.back();</script>";
   }
 }
 
?>