<?php
    include "./includes/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="./assets/css/homepage.css">
</head>
<body>
    <div class="carousel">
        <div class="slider">
            <div class="item">
                <img src="./assets/images/caraousel/1.jpg" alt="image1">
                <div class="content">
                    
                </div>
            </div>
            <div class="item">
                <img src="./assets/images/caraousel/2.jpg" alt="image2">
                <div class="content">
                    
                </div>
            </div>
            <div class="item">
                <img src="./assets/images/caraousel/3.jpg" alt="image3">
                <div class="content">
                    
                </div>
            </div>
            <div class="item">
                <img src="./assets/images/caraousel/4.jpg" alt="image4">
                <div class="content">
                    
                </div>
            </div>
        </div>

        <div class="thumbnail">
            <div class="item">
                <img src="./assets/images/caraousel/2.jpg" alt="image2">
            </div>
            <div class="item">
                <img src="./assets/images/caraousel/3.jpg" alt="image3">
            </div>
            <div class="item">
                <img src="./assets/images/caraousel/4.jpg" alt="image4">
            </div>
            <div class="item">
                <img src="./assets/images/caraousel/1.jpg" alt="image1">
            </div>
        </div>

        <div class="arrows">
            <button onclick="showSlider('prev')"><h3>&lt</h3></button>
            <button onclick="showSlider('next')"><h3>&gt</h3></button>
        </div>
    </div>

    <script src="./assets//js//home.js"></script>
</body>
</html>
<?php
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['user_type'])) {
        echo"hello {$_SESSION['user_type']}, {$_SESSION['user_id']}";
    }
    session_destroy();
    include "./includes/footer.php";
?>

