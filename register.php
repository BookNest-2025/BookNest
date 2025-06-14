<?php
  include("./includes/db.php");
  session_start();
  $error = "";

  if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordC'])) {
        
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
      $passwordC = trim($_POST['passwordC']);
      $category = "";

      if($password == $passwordC) {
          $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $result->num_rows == 1) {
            $error = "Email already taken.";
          } 
          elseif(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->close();

            $user = $_POST['user'] ?? '';
            switch ($user) {
              case 's' :
                $category = 'shops';
                break;
              case 'd' :
                $category = 'delivery_partners';
                break; 
              case '' :
                $category = 'customers';
                break; 
              default :
                $category = '';
            }

            if(!empty($category)) {
              $stmt = $conn->prepare("INSERT INTO users (email, password, category) VALUES (?, ?, ?)");
              $stmt->bind_param("sss", $email, $password, $category);       
              if ($stmt->execute()) {
                $stmt->close();
                $stmt = $conn->prepare("INSERT INTO " .$category. " (email) VALUES (?)");
                $stmt->bind_param("s", $email);
                  if($stmt->execute()) {
                    header("Location: login.php");
                    exit();
                  }
                  else {
                    $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt -> execute();
                    $stmt->close();
                    $error = "Registration failed. Please try again.";
                  } 
              } else {
                  $error = "Registration failed. Please try again.";
              }
            }
            else {
              $error = "Wrong category";
            }
          }
          else {
            $error = "Email not valid.";
          }
          }
      else {
        $error = "Passwords do not match.";
      }
    } else {
      $error = "Please fill in all fields.";
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
    <div class="page page-register">
      <div class="register">
        <form action="register.php" method="post">
          <h2>Hello! Welcome👋</h2>
          <h3>Register</h3>

          <div class="input-box">
            <input type="text" name="email" required placeholder="Enter a Valid Email"/>
            <button tabindex="-1" type="button"><i class='bx bxs-envelope'></i> </button>
            <span class="input-type">
              <p>Email</p>
            </span>
          </div>

          <div class="input-box">
            <input id="passIn" type="password" name="password" required placeholder="Enter a Strong Password" />
            <button tabindex="-1" id="passBtn" type="button" onclick="toggleView()"><i class="bx bxs-eye-slash"></i></button> 
            <span class="input-type">
              <p>Password</p>
            </span>
          </div>

          <div class="input-box">
            <input id="passInC" type="password" name="passwordC" required placeholder="Confirm Password" />
            <button tabindex="-1" id="passBtnC" type="button" onclick="toggleViewC()"><i class="bx bxs-eye-slash"></i></button> 
            <span class="input-type">
              <p>Confirm Password</p>
            </span>
          </div>

          <div class="input-box">
            <label><input class="radio" type="checkbox" name="advance-user" value="true" id="advance-user"><p>Advance user?</p></label>
            <div class="advance-users">
              <label><input class="radio" type="radio" name="user" value="s"><p>Shop</p></label>
              <label><input class="radio" type="radio" name="user" value="d"><p>Delevery Partner</p></label>
            </div>  
          </div>
                    
          <?php 
            if(!empty($error)) {
              echo '<p class="error-massage">' . $error . '</p>';
            }
          ?>
          <p class="error-massage"></p>
          <button type="submit" class="btn"><p>Signup</p></button>
          <div class="move-links">
            <p>
              <a href="login.php">
                Already have an account? <u>Signin</u></a
              >
            </p>
          </div>
        </form>
      </div>
    </div>

    <script src="./assets/js/login&register.js"></script>
  </body>
</html>
