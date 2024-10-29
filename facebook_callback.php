<?php
session_start();
require_once 'vendor/autoload.php'; // Include Facebook SDK

use Facebook\Facebook;

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fb = new Facebook([
  'app_id' => '1167420151033756',
  'app_secret' => '9e8d51a4bb552b2ef2da87622e9d759f',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // Handle Graph API errors
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // Handle SDK errors
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
    echo 'Access token not set';
    exit;
}

// Logged in, retrieve the user’s profile data
$oAuth2Client = $fb->getOAuth2Client();
$longLivedToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

$response = $fb->get('/me?fields=id,name,email', $longLivedToken);
$user = $response->getGraphUser();

$facebook_id = $user['id'];
$email = $user['email'];
$name = $user['name'];

// Check if the user already exists
$stmt = $conn->prepare("SELECT id FROM facebook_users WHERE facebook_id = ?");
$stmt->bind_param("s", $facebook_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    // User does not exist, insert into the database
    $stmt = $conn->prepare("INSERT INTO facebook_users (facebook_id, email, name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $facebook_id, $email, $name);
    $stmt->execute();
}

// Set session variables and redirect to homepage
$_SESSION['userid'] = $facebook_id;
$_SESSION['email'] = $email;
$_SESSION['username'] = $name;

header('Location: homepage.php');