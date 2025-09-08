<?php

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit("Forbidden");
}

  include "../app/config/db.php";
  session_start();

  //tells browser server is sending json format data rather than plain html or text.
  header("Content-Type: application/json");

  $response = ["success" => false, "error" => "","redirect" => ""];

  try {

    // checks already login or not
    if (isset($_SESSION['email'])) {
        $response['error'] = "Already logged in.";
        $response['redirect'] = 'index.html';
        echo json_encode($response);
        exit();
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // checks all fields are filled or not
    if (!$email || !$password) {
      $response['error'] = "Please fill in all fields.";
      echo json_encode($response);
      exit();
    }

    //checks if email is a valid email or not
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $response['error'] = "Email not valid.";
      echo json_encode($response);
      exit();
    }

    $stmt = $pdo-> prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    //checks not available user or password is not match
    if (!$user || !password_verify($password, $user['password'])) {
        $response['error'] = "Please enter a valid email & password.";
        echo json_encode($response);
        exit();
    }
    
    //success all
    $response["success"] = true;
    $_SESSION['user_type'] = $user['category'];
    $_SESSION['email'] = $email;
  }
  catch (Exception $e) {
    $response['error'] = "Login failed. Please try again.";
  }

  
  echo json_encode($response);
