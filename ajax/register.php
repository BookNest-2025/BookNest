<?php
include "../app/config/db.php";
session_start();
header("Content-Type: application/json"); // send JSON response

$response = ["success" => false, "error" => ""];

if (isset($_SESSION['user_id'])) {
    $response['error'] = "Already logged in.";
    echo json_encode($response);
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$passwordC = $_POST['passwordC'] ?? '';
$user = $_POST['user'] ?? '';

if (!$email || !$password || !$passwordC) {
    $response['error'] = "Please fill in all fields.";
    echo json_encode($response);
    exit();
}

if($password !== $passwordC) {
    $response['error'] = "Passwords do not match.";
    echo json_encode($response);
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows == 1) {
    $response['error'] = "Email already taken.";
    echo json_encode($response);
    exit();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['error'] = "Email not valid.";
    echo json_encode($response);
    exit();
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$category = match($user) {
    's' => 'shops',
    'd' => 'delevery_partners',
    default => 'customers',
};

$stmt->close();
$stmt = $conn->prepare("INSERT INTO users (email, password, category) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $passwordHash, $category);

if($stmt->execute()) {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO " .$category. " (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    if($stmt->execute()) {
        $response['success'] = true; // success
    } else {
        $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $response['error'] = "Registration failed. Please try again.";
    }
} else {
    $response['error'] = "Registration failed. Please try again.";
}

echo json_encode($response);
