<?php
  include("./includes/db.php");
  session_start();
  $error = "";

  if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
          $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result && $result->num_rows == 1) {
              $row = $result->fetch_assoc();
              if ( password_verify($password, $row['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['user_type'] = $row['category'];
                header("Location: index.php");
                exit();
  
              } else {
                  $error = "Incorrect email or password.";
              }
          } else {
              $error = "Incorrect email or password.";
          }
        }
        else {
          $error = "Email not valid.";
        }
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookNest</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/root.css" />
    <link rel="stylesheet" href="./assets/css/loginAndRegister.css" />
  </head>
  <body>
    <div class="page page-login">
      <div class="login">
        <form action="login.php" method="post">
         <h2>Welcome Back👋</h2>
          <h3>Login</h3>
          <div class="input-box">
            <input type="text" name="email" required placeholder="Enter Your Email"/>
            <button tabindex="-1" type="button"><i class="bx bxs-envelope"></i></button>
            <span class="input-type">
              <p>Email</p>
            </span>
          </div>
          <div class="input-box">
            <input id="passIn" type="password" name="password" required placeholder="Enter Your Password"/>
            <button tabindex="-1" id="passBtn" type="button" onclick="toggleView()"><i class="bx bxs-eye-slash"></i></button> 
            <span class="input-type">
              <p>Password</p>
            </span>
          </div>
          <p>
            <a href="./fogotPassword.php"><u>Forgot password?</u></a>
          </p>
          <?php 
            if(!empty($error)) {
              echo '<p class="error-massage">' . $error . '</p>';
            }
          ?>
          <button type="submit" class="btn"><p>Signin</p></button>
          <div class="move-links">
            <p>
              <a href="register.php">
                Don't have an account? <u>Signup</u></a
              >
            </p>
          </div>
        </form>
      </div>
    </div>

    <script src="./assets/js/login&register.js"></script>
  </body>
</html>