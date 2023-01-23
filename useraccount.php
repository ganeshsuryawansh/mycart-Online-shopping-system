<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';

session_start();
$log = $_SESSION['loggedin'];

try {
    if ($log) {
        //header("location: buynow.php");
    } else {
        header("location: login.php");
    }
} catch (Exception $e) {
    echo ($e);
}


$email = $_SESSION['email'];
//echo($email);
$qu = "SELECT * FROM `users` WHERE `email` = '$email' ";
$query = mysqli_query($conn, $qu);
$arr = mysqli_fetch_array($query);
//$num = mysql_num_rows($query); 
$name = $arr['username'];
$state = $arr['state'];
$dist = $arr['district'];
$subdist = $arr['subdistrict'];
$city = $arr['city'];
$zipcode = $arr['zipcode'];
$phone = $arr['phone'];
$email1 = $arr['email'];
$userno = $arr['no'];

$_SESSION['email'] = $email1;
$_SESSION['no'] = $userno;
$_SESSION['username'] = $name;

?>

<style>
    .img {
        height: 120px;
        width: 120px;
    }
</style>
<div class="container my-5">
    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="images/avatars.png" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($arr['username']); ?></h5>
                            <p class="card-text">
                            <p class="card-text">
                            <h6>Phone: </h4>+91<?php echo ($arr['phone']); ?></p>
                                <p class="card-text">
                                <h6>Email: </h4><?php echo ($arr['email']); ?></p>
                                    <p class="card-text">
                                    <h4>Address :</h4><?php echo ($arr['city'] . " " . $arr['subdistrict'] . "  " . $arr['district'] . "  " . $arr['state'] . "-" . $arr['zipcode']); ?></p>
                                    <p class="card-text"><small class="text-muted">Last updated 1 Years ago..</small></p>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <h4>MY ORDERS</h4>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">DATE</th>
                        <th scope="col">ACTION</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $queryproid = mysqli_query($conn, "SELECT * FROM myorders WHERE email_id = '$email'");
                    while ($row = mysqli_fetch_array($queryproid)) {
                        $prod_id = $row['productid'];

                        $query = mysqli_query($conn, "SELECT * FROM products WHERE pid ='$prod_id'");
                        while ($row = mysqli_fetch_array($query)) {

                            $name = $row['pname'];
                            $price = $row['pprice'];
                            $img = $row['pimg'];
                            $date = $row['date'];
                    ?>

                            <tr>
                                <th scope="row"></th>
                                <td><img src="images/product/<?php echo ($img); ?>" class="img-fluid rounded-start img pimg mx-3" alt="..."><?php echo ($name); ?></td>
                                <td><?php echo ($price); ?></td>
                                <td><?php echo ($date); ?></td>
                                <td><a href="useraccount.php?ruid=<?php echo ($prod_id); ?>" class="btn btn-danger">Cancel</a></td>
                                <?php
                                $cancelprodid = $_GET['ruid'];
                                
                                $sql = "DELETE FROM `myorders`WHERE `productid`= $cancelprodid";
                                $result = mysqli_query($conn, $sql);
                                ?>
                            </tr>


                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="col">
            <div class="card">
                <h5 class="card-header">
                    PAYMENTS</h5>
                <div class="card-body">
                    <h5 class="card-title">Gift cards</h5>
                    <hr>
                    <h5 class="card-title">Saved UPI</h5>
                    <hr>
                    <h5 class="card-title">Saved cards</h5>
                </div>
            </div>
            <hr>
            <div class="card">
                <h5 class="card-header">
                    MY STUFF</h5>
                <div class="card-body">
                    <h5 class="card-title">My Coupons</h5>
                    <hr>
                    <h5 class="card-title">My Reviews & Ratings</h5>
                    <hr>
                    <h5 class="card-title">All Notifications</h5>
                    <hr>
                    <h5 class="card-title">My Wishlist</h5>
                </div>
            </div>
        </div>

    </div>
</div>