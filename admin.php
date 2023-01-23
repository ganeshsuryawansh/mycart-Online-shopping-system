<?php
include 'includes/dbconnect.php';
error_reporting(E_ALL ^ E_NOTICE);

$login = false;
$showError = false;

if (true/*$_SERVER["REQUEST_METHOD"] == "POST"*/) {
    include 'includes/dbconnect.php';
    //echo("inside first if");
    $email = $_POST["email"];
    $password = $_POST["password"];
    echo ($email);

    $sql = "SELECT * FROM admins WHERE emailid = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    //echo ($num);
    if (true/*$num = mysqli_num_rows($result)*/) {
        //echo("inside second if");
        while ($row = mysqli_fetch_assoc($result)) {

            if ($password == $row['password']) {
                $login = true;
                session_start();
                $_SESSION['Adloggedin'] = true;
                //$_SESSION['email'] = $email;
                header("location: adminpanel.php");
            } else {
                $showError = "Invalid Credentialss";
            }
        }
    } else {
        $showError = "Invalid Credentials";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Admin-LOGIN</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">mycart-Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">LOGIN</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <?php
    if ($login) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    ?>
    <div class="container my-5">

        <div class="row">
            <div class="col">
                <div class="card" style="width: 25rem; height:310px;">
                    <div class="card-body">



                        <form action="admin.php" method="post">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <button type="submit" class="btn btn-primary">LOGIN AS ADMIN</button>
                            <?php

                            ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <h4>ADMIN RULES AND OPERATIONS</h4>
                        <hr>
                        <h6>Add Product </h6>
                        <h6>Add Category</h6>
                        <h6>Remove Product</h6>
                        <h6>Manage Users</h6>
                        <h6>All System Access</h6>
                        <h6>All Moderator Access</h6>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">Check Rules and Operations</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>