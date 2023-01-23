<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$log = $_SESSION['loggedin'];
?>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        .brend_logo {
            height: 50px;
            width: 120px;
        }

        .cart_logo {
            height: 50px;
            width: 50px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/ecommerce/"><img src="images/Brand_logo.jpeg" class="brend_logo" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/ecommerce/">Home</a>
                    </li>

                    <li class="nav-item">
                        <?php


                        try {
                            if ($log) {
                                //code here
                            } else {
                        ?>
                                <a class="nav-link active" aria-current="page" href="http://localhost/ecommerce/signup.php">Signup</a>
                        <?php
                            }
                        } catch (Exception $e) {
                            echo ($e);
                        }
                        ?>
                    </li>

                </ul>

                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <ul class="navbar-nav container me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="http://localhost/ecommerce/useraccount.php">MyAcount</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">

                            <!----
                            <form class="d-flex" role="search">
                                <input class="form-control me-2 searchbar" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-warning mx-3" type="submit">Search</button>
                            </form>
                            ---->
                            <?php
                            try {
                                if ($log) {
                                    //header("location: buynow.php");
                            ?>
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
                                        <button class="btn btn-primary" type="button"><?php echo ($_SESSION['username']); ?></button>
                                    </span>
                            <?php
                                } else {
                                    //header("location: login.php");
                                }
                            } catch (Exception $e) {
                                echo ($e);
                            }
                            ?>
                            <a class="cart_logo mx-5" aria-current="page" href="http://localhost/ecommerce/cart.php?"><img src="images/Cart-PNG.png" class="cart_logo" alt=""></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        function logout() {
            <?php
            $_SESSION['loggedin'];
            //session_destroy();
            ?>
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>