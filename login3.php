<?php
include 'includes/nav.php';
error_reporting(E_ALL ^ E_NOTICE);
$login = false;
$showError = false;



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'includes/dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    //echo($num);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {

            //echo ($row['password']);

            if ($password == $row['password']) {

                $login = true;
                //session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                header("location: index.php");
            } else {
                $showError = "Invalid Credentialss";
            }
        }
    } else {
        $showError = "Invalid Credentials";
    }
}

/*

clint id : 244775550056-gdouh60gd3ae6v5fneie9u0tpc84n3d5.apps.googleusercontent.com

Clint secreate: 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
*/
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
    <style>
        .cont {
            background-color: pink;
            height: 900px;
        }

        .offerimg {
            height: 500px;
            width: 550px;
            margin-right: 255px;
            border-radius: 10px 10px 10px 10px;
        }
    </style>
</head>

<body>

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
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }


    ?>

    <div class="container cont my-5">
        <h1 class="text-left">Login to our website</h1>


        <div class="container cont2 text-left">
            <div class="row">
                <div class="col-5 cold">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-warning my-3">Login</button>

                        <?php



                        ?>
                        <?php
                        /*
                        require_once 'vendor/autoload.php';
                        // init configuration
                        $clientID = '244775550056-gdouh60gd3ae6v5fneie9u0tpc84n3d5.apps.googleusercontent.com';
                        $clientSecret = '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';
                        $redirectUri = 'http://localhost/ecommerce/';

                        // create Client Request to access Google API
                        $client = new Google_Client();
                        $client->setClientId($clientID);
                        $client->setClientSecret($clientSecret);
                        $client->setRedirectUri($redirectUri);
                        $client->addScope("email");
                        $client->addScope("profile");

                        // authenticate code from Google OAuth Flow
                        if (isset($_GET['code'])) {
                            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                            $client->setAccessToken($token['access_token']);

                            // get profile info
                            $google_oauth = new Google_Service_Oauth2($client);
                            $google_account_info = $google_oauth->userinfo->get();
                            $email =  $google_account_info->email;
                            $name =  $google_account_info->name;
                            echo $google_account_info;

                            // now you can use this profile info to create account in your website and make user logged in.

                        } else {

                            echo "<a class ='btn btn-primary' href='" . $client->createAuthUrl() . "'>Google </a>";
                            
                        }
                        */
                        ?>
                        <hr>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Forgot password
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="login.php" method="POST">

                                            <div class="form-group col-md-6">
                                                <label for="Username">Enter New Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="" name="password" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="Username">Confirm Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="" name="cpassword" required>
                                                </div>
                                            </div>
                                            <?php
                                            /*
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                $email = $_SESSION['email'];
                                                $password = $_POST["password"];
                                                $cpassword = $_POST["cpassword"];

                                                if($password==$cpassword){

                                                }
                                                else{
                                                    echo"Password not match";
                                                }


                                                $sql = mysqli_query($conn,  "SELECT * FROM users WHERE email = '$email'");
                                            }
                                            */
                                            ?>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-primary my-2">Forgot Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-4 ">
                    <div class="container offercontainer">
                        <a href="http://localhost/ecommerce/">
                            <img src="images/banner/banneroffer.jpg" class="offerimg" alt="offer">
                        </a>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <div class="foot fixed-bottom">
        <?php
        //include 'includes/footer.php';
        ?>
    </div>
</body>

</html>