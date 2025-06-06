<?php
  include("./includes/db.php");
  session_start();
  $error = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['adminId']) && isset($_POST['password'])) {
        $admin_id = $_POST['adminId'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM admins WHERE admin_id = ?");
        $stmt->bind_param("s", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows === 1) {
          $row = $result->fetch_assoc();
          if ( password_verify($password, $row['password'])) {
              $_SESSION['admin_id'] = $row['admin_id'];
              mysqli_close($conn);
              header("Location: index.php");
              exit();
          } else {
              $error = "Incorrect admin id or password.";
          }
        } else {
          $error = "Incorrect admin id or password.";
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
        <form action="ad.php" method="post">
          <h2>Welcome Back👋</h2>
          <h3>Admin Login</h3>
          <div class="input-box">
            <input type="text" name="adminId" required />
            <button type="button" tabindex="-1"><i class="bx bxs-user"></i></button>
            <span class="input-type">
              <p>Admin ID</p>
            </span>
          </div>
          <div class="input-box">
            <input id="passIn" type="password" name="password" required />
            <button id="passBtn" type="button" onclick="toggleView()" tabindex="-1"><i class="bx bxs-eye-slash"></i></button> 
            <span class="input-type">
              <p>Password</p>
            </span>
          </div>
          <p class="error-massage">
            <?php if(isset($error))  {
            echo"$error";
          }?></p>
          <button type="submit" class="btn"><p>Login</p></button>
        </form>
      </div>  
    </div>

    <script src="./assets/js/login&register.js"></script>
  </body>
</html>