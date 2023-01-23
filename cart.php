<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
error_reporting(E_ALL ^ E_NOTICE);
//session_start();

$log = $_SESSION['loggedin'];
$email = $_SESSION['email'];
try {
    if ($log) {
        //header("location: buynow.php");
    } else {
        header("location: login.php");
    }
} catch (Exception $e) {
    echo ($e);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        .img {
            height: 200px;
            width: 200px;
        }

        .procrd {
            width: 550px;
            border: 1px solid black;
        }

        .prccrd {
            /*width: 500px;*/
        }

        .maincol {
            width: 50%;
        }

        body {
            background-color: #b891ff;
        }

        .text {
            text-decoration: none;
            color: black;
        }

        .offerimg {
            height: 500px;
            width: 550px;
            margin-left: -350px;
        }
    </style>
</head>

<body>

    <?php

    $id = $_GET['id'];
    //echo ($id);
    if (isset($id)) {
        $sql = "INSERT INTO `usercart` (`pro_id`,`emailid`) VALUES ('$id','$email')";
        $result = mysqli_query($conn, $sql);
    } else {
        //echo ("Error in product id section....");
    }


    $queryproid = mysqli_query($conn, "SELECT * FROM usercart WHERE emailid='$email'");
    $row = mysqli_fetch_array($queryproid);

    if ($row != true) {
        //header("location: cart.php");
    }
    $tamt = 0;
    ?>

    <div class="container text-center my-5">
        <div class="row">
            <div class="col-6">
                <?php
                $queryproid = mysqli_query($conn, "SELECT * FROM usercart WHERE emailid = '$email'");
                while ($row = mysqli_fetch_array($queryproid)) {
                    $fid = $row['pro_id'];
                    //echo ($fid . "  ");
                    $query = mysqli_query($conn, "SELECT * FROM products WHERE pid ='$fid'");
                    while ($row = mysqli_fetch_array($query)) {

                        $name = $row['pname'];
                        $price = $row['pprice'];
                        $img = $row['pimg'];
                        $info = $row['pdesc'];
                        $tamt = $tamt + $price;
                        $id = $row['pid'];


                ?>
                        <div class="row">
                            <div class="col">

                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="images/product/<?php echo ($img); ?>" class="img-fluid rounded-start img pimg mx-3" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <a href="http://localhost/ecommerce/product.php?product=<?php echo ($id);  ?>">
                                                    <h5 class="card-title text"><?php echo ($name); ?></h5>
                                                    <h5 class="card-title text">₹ <?php echo ($price); ?></h5>
                                                    <a href="cart.php?rid=<?php echo ($id); ?>" class="btn btn-warning my-5">Remove From Cart</a>

                                                    <?php
                                                    $removeid = $_GET['rid'];
                                                    //echo($removeid);
                                                    //DELETE FROM table_name WHERE condition;
                                                    $sql = "DELETE FROM `usercart`WHERE `pro_id`= $removeid";
                                                    $result = mysqli_query($conn, $sql);
                                                    ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        //echo ($price . " " . $name . "       ");
                        //echo ($tamt);
                    }
                }
                error_reporting(0);
                ?>
            </div>
            <div class="col-6">
                <div class="card border-warning mb-3 procrd bg-$pink" style="max-width: 18rem;">
                    <div class="card-header ">PRICE DETAILS</div>
                    <div class="card-body">
                        <h5 class="card-title">Price(all items))</h5>
                        <hr>
                        <h5>Delivery Charges: ₹ 00</h5>
                        <hr>
                        <h5><b>
                                Total Amount: ₹ <?php echo ($tamt); ?>
                            </b></h5>


                        <a href="cart_pay.php?emid=<?php echo ($email); ?>" class="btn btn-warning">PLACE ORDER</a>

                        <?php
                        $_SESSION["totalcartamt"] = $tamt;


                        ?>
                    </div>
                </div>
                <div class="container offercontainer">
                    <img src="images/product/megasale.img.png" class="offerimg" alt="offer">
                </div>
            </div>
        </div>
    </div>


    <?php
    //include 'includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
<?php
include 'includes/footer.php';
?>