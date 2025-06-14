<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest</title>
    <link rel="stylesheet" href="..//assets//css//root.css" />
    <link rel="stylesheet" href="../assets/css/new_arrivals.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

    <?php

    include("category.php");

    ?>

    <div class="new_arrivals_main">
        <div class="new_arrivals_top">
            <h1>New Arrivals</h1>
            <button>
                <a href="#">View All</a>
            </button>
        </div>
        <div class="new_arrivals_container">
            <div class="new_books">
                <div class="new_books_container">
                    <img src="..//assets//images//The_Midnight_Library_Book.jpg" alt="">
                    <div class="new_books_inside">
                        <h2>The Midnight Library</h2>
                        <h4>Matt Haig</h4>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="new_arrivals_bottom">
                    <h3>$ 18.89</h3>
                    <button>
                        <i class="fa-solid fa-cart-shopping"></i>
                        Add
                    </button>
                </div>
            </div>

            <div class="new_books">
                <div class="new_books_container">
                    <img src="..//assets//images//The_Midnight_Library_Book.jpg" alt="">
                    <div class="new_books_inside">
                        <h2>The Midnight Library</h2>
                        <h4>Matt Haig</h4>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="new_arrivals_bottom">
                    <h3>$ 18.89</h3>
                    <button>
                        <i class="fa-solid fa-cart-shopping"></i>
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>