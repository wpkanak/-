<?php
// Validate form inputs
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if all fields are filled out
if (empty($name) || empty($email) || empty($password)) {
    die("Error: All fields are required.");
}

// Check if email is in valid format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email format.");
}

// Save profile picture to server
$target_dir = "uploads/";
$timestamp = time();
$target_file = $target_dir . $timestamp . "_" . basename($_FILES["profile_picture"]["name"]);
if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars(basename($_FILES["profile_picture"]["name"])) . " has been uploaded.";
} else {
    die("Error: There was an error uploading your file.");
}

// Save user's information to CSV file
$users_file = fopen("users.csv", "a");
fwrite($users_file, $name . "," . $email . "," . $target_file . "\n");
fclose($users_file);

// Start a new session and set a cookie with the user's name
session_start();
$_SESSION['name'] = $name;
setcookie("user", $name, time() + 3600);  // Set cookie to expire in 1 hour

// Redirect to success page
header("Location: success.php");
exit();
?>
