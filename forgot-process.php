<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include 'source/class/user.php';
$user = new user();

$username = $_POST['username'];
$new_password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Check if username exists in the database
$userExists = $user->checkUserName($username);

if (!$userExists) {
    echo "Username does not exist.";
    exit;
}

// Check if passwords match
if ($new_password === $confirm_password) {
    // $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
    $change_password = $user->updatePassword($new_password, $username);
    
    if ($change_password) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password. Please try again.";
    }
} else {
    echo "Passwords do not match.";
}
exit;
