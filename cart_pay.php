<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
error_reporting(E_ALL ^ E_NOTICE);

$email = $_GET['emid'];

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .paydet {
            border: 1px solid black;
            background-color: #ffe6e6;
        }

        .img {
            height: 120px;
            width: 120px;
        }

        .btn {
            height: 50px;
        }

        .text {
            text-decoration: none;
            color: black;
        }

        form:hover {
            box-shadow: 0px red;
        }
    </style>

</head>

<body>
    <div class="container my-5">
        <div class="row">
            <h3>Payer details</h3>
            <div class="col paydet">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
                while ($row = mysqli_fetch_array($query)) {
                    $usern = $row['username'];
                    $state = $row['state'];
                    $district = $row['district'];
                    $subdistrict = $row['subdistrict'];
                    $city = $row['city'];
                    $zipcode = $row['zipcode'];
                    $phone = $row['phone'];
                    $alterphone = $row['alphone'];
                }
                ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Name:</h5>
                    </label>
                    <?php echo ($usern); ?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Email:</h5>
                    </label>
                    <?php echo ($email); ?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Mobile:</h5>
                    </label>
                    <?php echo ($phone); ?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Address:</h5>
                    </label>
                    <?php echo ($city . " " . $subdistrict . " " . $district . " " . $state . "-" . $zipcode); ?>
                </div>
                <a class="btn btn-warning py-2 by-5" href="ordertrack.php?pid=<?php echo ($pid); ?>">Cash on Delivery
                </a><br>
                <br>
                <form action="verify.php ">
                    <script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_KieuS2HPO6ps21" async> </script>
                </form>
                <script>
                    function nextpage() {
                        window.location.href = "ordertrack.php";
                    }
                </script>
            </div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NAME</th>
                            <th scope="col">PRICE</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryproid = mysqli_query($conn, "SELECT * FROM usercart WHERE emailid = '$email'");
                        while ($row = mysqli_fetch_array($queryproid)) {

                            $fid = $row['pro_id'];
                            $tamt=0;
                            $query = mysqli_query($conn, "SELECT * FROM products WHERE pid ='$fid'");
                            while ($row = mysqli_fetch_array($query)) {
                                $name = $row['pname'];
                                $price = $row['pprice'];
                                $img = $row['pimg'];
                                $tamt = $tamt + $price;
                                $id = $row['pid'];

                                $myorder = "INSERT INTO `myorders` (`productid`, `email_id`) VALUES ('$id', '$email')";
                                $result = mysqli_query($conn, $myorder);
                        ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td><img src="images/product/<?php echo ($img); ?>" class="img-fluid rounded-start img pimg mx-3" alt="..."><?php echo ($name); ?></td>
                                    <td><?php echo ($price); ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
            </div>
        </div>
    </div>
</body>
<?php
//include 'includes/footer.php';
?>