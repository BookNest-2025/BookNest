<?php
  include("./includes/db.php");
  session_start();
  $error = "";

  if (isset($_SESSION['supplier_id'])) {
    header("Location: index.php");
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['supplierID']) && isset($_POST['password'])) {
        $supplier_id = $_POST['supplierID'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM suppliers WHERE supplier_id = ?");
        $stmt->bind_param("s", $supplier_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
          $row = $result->fetch_assoc();
          if ( password_verify($password, $row['password'])) {
              $_SESSION['supplier_id'] = $row['supplier_id'];
              mysqli_close($conn);
              header("Location: index.php");
              exit();
          } else {
              $error = "Incorrect username or password!";
          }
        } else {
          $error = "Incorrect username or password!";
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
        <form action="login-supplier.php" method="post">
          <h2>Welcome Back 👋</h2>
          <h3>Supplier Login</h3>
          <div class="input-box">
            <input type="text" name="supplierID" required />
            <button type="button" tabindex="-1"><i class="bx bxs-user"></i></button>
            <span class="input-type">
              <p>Username</p>
            </span>
          </div>
          <div class="input-box">
            <input id="passIn" type="password" name="password" required />
            <button id="passBtn" type="button" onclick="toggleView()" tabindex="-1"><i class="bx bxs-eye-slash"></i></button> 
            <span class="input-type">
              <p>Password</p>
            </span>
          </div>
          <p>
            <a href="#"><u>Forgot password?</u></a>
          </p>
          <p class="error-massage">
            <?php if(!empty($error))  {
            echo"$error";
          }?></p>
          <button type="submit" class="btn"><p>Login</p></button>
          <div class="move-links">
            <p>
              <a href="login.php">
                Are you a User? <u>Login</u></a>
            <p>
              <a href="register.php">
                Don't have an account? <u>Register</u></a>
            </p>
          </div>
        </form>
      </div>
    </div>

    <script src="./assets/js/login&register.js"></script>
  </body>
</html>