<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit("Forbidden");
}

include "../app/config/db.php"; 
session_start();

header("Content-Type: application/json");
$response = ["success" => false, "message" => "", "error" => "", "redirect" => ""];

try {
    if (!isset($_SESSION["email"]) || !isset($_SESSION["user_type"])) { 
        $response["redirect"] = "login.html";
        throw new Exception("Please login to add books.");
    }

    if( $_SESSION["user_type"] !== "shops") {
        $response["redirect"] = "login.html";
        throw new Exception("You should login as shop to add books.");
    }

    $file = $_FILES["poster"] ?? "";
    $title = $_POST["title"] ?? "";
    $price = $_POST["price"] ?? '0';
    $quantity = $_POST["quantity"] ?? '0';
    $description = $_POST["description"] ?? "";
    $category = $_POST["category"] ?? "";

    if(!$file || !$title || !$description || !$category) {
        throw new Exception("Please fill in all fields.");
    }

    if($price <= 0) {
        throw new Exception("Price should be greater than 0.");
    }

    if($quantity < 1) {
        throw new Exception("Quantity should be greater than 0.");
    }

    $uploadDir = "../public/uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $targetFile = $uploadDir . time() . "_" . basename($file['name']);
    $allowed = ['jpg', 'png', 'jpeg'];
    $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    if (!in_array($ext, $allowed)) {
        throw new Exception("Invalid file type. Allowed: jpg, png, jpeg.");
    }

    if ($file['size'] > 5 * 1024 * 1024) { 
        throw new Exception("File too large. Max size 5MB.");
    }

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $response["message"] = "File uploaded successfully!";
    } else {
        throw new Exception("Failed to upload file.");
    }

    try{
        $pdo->beginTransaction();

        $email = $_SESSION["email"];
        $stmt = $pdo->prepare("SELECT * FROM shops WHERE email = :email");
        $stmt->execute(["email" => $email]);
        $sid = $stmt->fetch()["s_id"];
        $stmt = $pdo->prepare("INSERT INTO books (title, price, img_path, quantity, category, description, s_id) VALUES (:title, :price, :img_path, :quantity, :category, :description, :s_id)");
        $stmt->execute(["title" => $title, "price" => $price,"img_path" => $targetFile, "quantity"=> $quantity,"description"=> $description,"category"=> $category, "s_id" => $sid]);
        
        $pdo->commit();
        $response['success'] = true;
        $response['message'] = 'Book Added Successfully!.<br>Directing to Homepage...';
        $response['redirect'] = 'index.html';
    }
    catch (PDOException $e) {
        if (file_exists($targetFile)) {
            unlink($targetFile);
        }

        throw new Exception("Error saving data.");
    }

}catch (Exception $e) {
    $response["error"] = $e->getMessage();
}

echo json_encode($response);


