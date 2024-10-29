<?php
session_start();
require_once 'vendor/autoload.php'; // Include Facebook SDK

use Facebook\Facebook;

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Facebook App details
$fb = new Facebook([
  'app_id' => '1167420151033756',
  'app_secret' => '9e8d51a4bb552b2ef2da87622e9d759f',
  'default_graph_version' => 'v12.0',
]);

// OAuth 2.0 login URL
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/smart%20cart/facebook_callback.php', $permissions);

// Redirect to Facebook for login
header('Location: ' . $loginUrl);