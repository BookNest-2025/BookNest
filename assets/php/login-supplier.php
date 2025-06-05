<?php
  include("../../includes/db.php");
  session_start();
  $error = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['supplierID']) && isset($_POST['password'])) {
        $admin_id = $_POST['supplierID'];
        $password = $_POST['supplierID'];

        $query = "SELECT * FROM suppliers WHERE supplier_id = '$admin_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ( password_verify($password, $row['password'])) {
                $_SESSION['customer_id'] = $row['customer_id'];
                mysqli_close($conn);
                header("Location: index.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Admin ID not found.";
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
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet" />
    <link rel="stylesheet" href="../css/root.css" />
    <link rel="stylesheet" href="../css/loginAndRegister.css" />
  </head>
  <body>
    <div class="page page-login">
      <div class="login">
        <form action="login.php" method="post">
          <h2>Welcome Back!</h2>
          <h3>Supplier Login</h3>
          <div class="input-box">
            <input type="text" name="supplierID" required />
            <i class="bx bxs-user"></i>
            <span class="input-type">
              <p>Username</p>
            </span>
          </div>
          <div class="input-box">
            <input type="password" name="password" required />
            <i class="bx bxs-lock-alt"></i>
            <span class="input-type">
              <p>Password</p>
            </span>
          </div>
          <p class="error-massage">
            <?php if(isset($error))  {
            echo"$error";
          }?></p>
          <button type="submit" class="btn"><p>Login</p></button>
          <div class="move-links">
            <p>
              <a href="login-admin.php">
                Are you a User? <u>Login</u></a
              >
            <p>
              <a href="login-admin.php">
              Are you an Admin? <u>Admin Login</u></a
              >
            </p>
            <p class="reg-link">
              <a href="register.php">
                Don't have an account? <u>Register</u></a
              >
            </p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>