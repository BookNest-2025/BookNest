<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookNest</title>
    <link rel="stylesheet" href=".//assets//css//root.css" />
    <link rel="stylesheet" href=".//assets//css//navbar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src=".//assets//images//logo.png" alt="Logo" />
        </div>

        <ul class="navbar-center">
            <li><a href="#">Home</a></li>
            <li><a href="#">Books</a></li>
            <li><a href="#">Reviews</a></li>
            <li><a href="#">Admin</a></li>
        </ul>

        <div class="navbar-right">
            <div class="icon-row">
                <i class="fa fa-search" id="search-icon"></i>
                <a href="#"><i class="fa fa-user"></i></a>
                <a href="#"><i class="fa fa-shopping-cart"></i></a>
                <i class="fa fa-bars menu-toggle" id="menu-toggle"></i>
            </div>
        </div>
    </nav>
    <div class="search-panel" id="search-panel">
        <input type="text" id="search-input-field" placeholder="Search books..." />
    </div>
    <div id="toggle-handler-search"></div>
    <div id="toggle-handler-menu"></div>

    <div class="navbar-background">
    </div>

    <script src=".//assets/js//navbar.js"></script>
</body>

</html>