<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit("Forbidden");
}


include "../app/config/db.php"; 
session_start();

//tells browser server is sending json format data rather than plain html or text.
header("Content-Type: application/json");

$response = ["success" => false, "error" => "", "redirect" => ""];

try {
    //checks if user already logged in or not?
    if (isset($_SESSION['email'])) {
        $response['redirect'] = 'index.html';
        throw new Exception('Already logged in. Please log out to register.');
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordC = $_POST['passwordC'] ?? '';
    $user = $_POST['user'] ?? '';

    // checks any values are empty or not?
    if (!$email || !$password || !$passwordC) {
        throw new Exception('Please fill in all fields.');
    }

    // checks paswords are equal or not?
    if ($password !== $passwordC) {
        throw new Exception('Passwords do not match.');
    }

    // checks email is valid or not?
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Email not valid.');
    }

    // checks email is already taken or not?
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        throw new Exception('Email already taken.');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // set category variable according to the user type
    $category = match($user) {
        's' => 'shops',
        'd' => 'delevery_partners',
        default => 'customers',
    };

    try {// Use transaction for atomic insert. all queries after will not be permenetly written until use commit.
        $pdo->beginTransaction();

        // Insert into users
        $stmt = $pdo->prepare("INSERT INTO users (email, password, category) VALUES (:email, :password, :category)");
        $stmt->execute(['email' => $email, 'password' => $passwordHash, 'category' =>  $category]);

        // Insert into specific category table
        $stmt = $pdo->prepare("INSERT INTO {$category} (email) VALUES (:email)");
        $stmt->execute(["email" => $email]);

        $pdo->commit();
        $response['success'] = true;
        $response['message'] = 'Registerd Successfully!<br>Directiong to Login page...';
        $response['redirect'] = 'login.html';
    } 
    catch (PDOException $e) {
        // if any error occures after transaction process start, rollback them to avoid saving missing data.
        $pdo->rollBack();
        throw new Exception("Registration faild! Please try again.");
    }

} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
?>