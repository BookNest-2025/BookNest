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
        $response['error'] = "Already logged in. Please log out to register.";
        $response['redirect'] = 'index.html';
        echo json_encode($response);
        exit();
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordC = $_POST['passwordC'] ?? '';
    $user = $_POST['user'] ?? '';

    // checks any values are empty or not?
    if (!$email || !$password || !$passwordC) {
        $response['error'] = "Please fill in all fields.";
        echo json_encode($response);
        exit();
    }

    // checks paswords are equal or not?
    if ($password !== $passwordC) {
        $response['error'] = "Passwords do not match.";
        echo json_encode($response);
        exit();
    }

    // checks email is valid or not?
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['error'] = "Email not valid.";
        echo json_encode($response);
        exit();
    }

    // checks email is already taken or not?
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        $response['error'] = "Email already taken.";
        echo json_encode($response);
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // set category variable according to the user type
    $category = match($user) {
        's' => 'shops',
        'd' => 'delevery_partners',
        default => 'customers',
    };

    // Use transaction for atomic insert. all queries after will not be permenetly written until use commit.
    $pdo->beginTransaction();

    // Insert into users
    $stmt = $pdo->prepare("INSERT INTO users (email, password, category) VALUES (:email, :password, :category)");
    $stmt->execute(['email' => $email, 'password' => $passwordHash, 'category' =>  $category]);

    // Insert into specific category table
    $stmt = $pdo->prepare("INSERT INTO {$category} (email) VALUES (?)");
    $stmt->execute([$email]);

    $pdo->commit();
    $response['success'] = true;

} catch (Exception $e) {
    // if any error occures after transaction process start, rollback them to avoid missing data.
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $response['error'] = "Registration failed. Please try again.";
}

echo json_encode($response);
?>