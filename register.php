<?php 
  include("includes/navbar.php");
?>

<?php
  include("./includes/db.php");
  session_start();
  $error = "";

  if (isset($_SESSION['customer_id'])) {
    header("Location: index.php");
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordC'])) {
        
        $customer_id = $_POST['username'];
        $password = $_POST['password'];
        $passwordC = $_POST['passwordC'];

        if($password == $passwordC) {
            $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = ?");
            $stmt->bind_param("s", $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows == 1) {
                $error = "Username already taken.";
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO customers (customer_id, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $customer_id, $password);       
                if ($stmt->execute()) {
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Registration failed. Please try again.";
                }
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
    <div class="page page-login">
      <div class="login">
        <form action="register.php" method="post">
          <h2>Hello! Welcome👋</h2>
          <h3>Register</h3>
          <div class="input-box">
            <input type="text" name="username" required />
            <button tabindex="-1" type="button"><i class="bx bxs-user"></i></button>
            <span class="input-type">
              <p>Username</p>
            </span>
          </div>
          <div class="input-box">
            <input id="passIn" type="password" name="password" required />
            <button tabindex="-1" id="passBtn" type="button" onclick="toggleView()"><i class="bx bxs-eye-slash"></i></button> 
            <span class="input-type">
              <p>Password</p>
            </span>
          </div>
          <div class="input-box">
            <input id="passInC" type="password" name="passwordC" required />
            <button tabindex="-1" id="passBtnC" type="button" onclick="toggleViewC()"><i class="bx bxs-eye-slash"></i></button> 
            <span class="input-type">
              <p>Confirm Password</p>
            </span>
          </div>
          <p class="error-massage">
            <?php if(!empty($error))  {
            echo"$error";
          }?></p>
          <button type="submit" class="btn"><p>Register</p></button>
          <div class="move-links">
            <p>
              <a href="register-supplier.php">
                Are you a Supplier? <u>Register</u></a
                >
            </p>
            <p>
              <a href="login.php">
                Already have an account? <u>Login</u></a
              >
            </p>
          </div>
        </form>
      </div>
    </div>

    <script src="./assets/js/login&register.js"></script>
  </body>
</html>

<?php
  include("includes/footer.php");
?>