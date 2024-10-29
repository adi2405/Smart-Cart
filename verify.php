<?php
session_start();
require_once 'vendor/autoload.php';

// Database connection details
$servername = "localhost"; // Update this if needed
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "login"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Specify the CLIENT_ID from the Google Cloud Console
$clientID = "450726384001-l075m6t166ijfc1mb5ufhnppklni8su0.apps.googleusercontent.com";

// Get the token from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$token = $data['token'];

if ($token) {
    $client = new Google_Client(['client_id' => $clientID]);  // Specify your CLIENT_ID
    $payload = $client->verifyIdToken($token);

    if ($payload) {
        $google_id = $payload['sub'];  // Google's unique user ID for this user
        $email = $payload['email'];
        $nameFromEmail = explode('@', $email)[0]; 

        // Check if the user already exists in the database
        $stmt = $conn->prepare("SELECT id FROM google_users WHERE google_id = ?");
        $stmt->bind_param("s", $google_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            // User does not exist, insert them into the database
            $stmt = $conn->prepare("INSERT INTO google_users (google_id, email, nameFromEmail) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $google_id, $email, $nameFromEmail);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'User registered']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to register user']);
            }
        } else {
            echo json_encode(['success' => true, 'message' => 'User already exists']);
        }

        // Set session variables
        $_SESSION['userid'] = $google_id;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $nameFromEmail;

    } else {
        // Invalid ID token
        echo json_encode(['success' => false, 'message' => 'Invalid token']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No token provided']);
}

// Close the connection
$conn->close();
?>