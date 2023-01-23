<?php
include 'includes/dbconnect.php';
?>
<?php 
error_reporting(E_ALL ^ E_NOTICE);

session_start();

$log = $_SESSION['Adloggedin'];
//$email=$_SESSION['email'];
try {
    if ($log) {
        //header("location: buynow.php");
    } else {
        header("location: admin.php");
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
    <title>Admin-mycart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        .pimg {
            height: 150px;
            width: 150px;
        }

        .td {
            border: 1px solid black;
        }
    </style>

    <script>
        function delay() {
            //window.location = "http://www.sololearn.com";
            console.log("hello after five minutes");
            let a = document.getElementById('adminlog');

            let b = document.getElementById('body');
            b.style.display ="block";
            if(1<22){
                b.style.display ="block";
            }
            else{
                x.style.display ="none"
            }
            console.log(b);

        }
    </script>
</head>

<body onLoad="setTimeout('delay()', 1000)" id="body">
    <div class="container" id="adminlog">

    </div>
    <script src="script.js"></script>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">mycart-Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">LOGOUT</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h4>Add Product</h4>
        <form action="/ecommerce/admin.php" method="POST">
            <div class="mb-3">
                <label for="exampleInput" class="form-label">Product name</label>
                <input type="text" class="form-control" name="pname" id="" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="exampleInput" class="form-label">product price</label>
                <input type="number" name="pprice" class="form-control" id="" required>
            </div>

            <div class="mb-3">
                <label for="exampleInput" class="form-label">Product information</label>
                <input type="text" class="form-control" name="pdesc" id="" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">product image</label>
                <input type="file" accept="jpeg/png/JPEG/JPG" name="pimg" class="form-control" id="" required>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">product category</label>
                <p><b>Categoris:</b> Electronics , Fashion , Furniture , grocery</p>
                <input type="text" class="form-control" name="pcat" id="" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">product sub category</label>
                <p><b>Categoris:</b> laptop , mens , womens , homes, watch</p>
                <input type="text" class="form-control" name="psubcat" id="" aria-describedby="emailHelp" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <hr>
    <div class="container">
        <h4>View products</h4>

        <table>
            <tr>
                <th class="td">Serial-No</th>
                <th class="td">Prod-name</th>
                <th class="td">prod-Details</th>
                <th class="td">Prod-Price</th>
                <th class="td">Action</th>
            </tr>
            <?php
            include 'includes/dbconnect.php';
            $query = mysqli_query($conn, "SELECT * FROM products");
            $srno = 0;
            while ($row = mysqli_fetch_array($query)) {
                $name = $row['pname'];
                $price = $row['pprice'];
                $info = $row['pdesc'];
                $img = $row['pimg'];
                $pid = $row['pid'];
                $srno++;
            ?>
                <tr>
                    <td class="td"><?php echo ($srno); ?></td>
                    <td class="td"><?php echo ($name); ?></td>
                    <td class="td"><img src="images/product/<?php echo ($img); ?>" class="pimg" alt="..."></td>
                    <td class="td">₹ <?php echo ($price); ?></td>
                    <td class="td"><a href="admin.php?delid=<?php echo ($pid); ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php
            }
            ?>
        </table>
        <?php
        $delid = $_GET['delid'];
        $sql = "DELETE FROM `products`WHERE `pid`= $delid";
        $result = mysqli_query($conn, $sql);
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
<?php

include 'includes/dbconnect.php';

if ($name == "") {


    $name = $_POST["pname"];
    $price = $_POST["pprice"];
    $info = $_POST["pdesc"];
    $image = $_POST["pimg"];
    $cate = $_POST["pcat"];
    $subcate = $_POST["psubcat"];

    $sql = "INSERT INTO `products` (`pname`, `pprice`, `pdesc`,`pimg`, `pcat`, `psubcat`) VALUES ('$name', '$price', '$info', '$image', '$cate', '$subcate')";
    $result = mysqli_query($conn, $sql);
    //print_r($sql);

}
?>

<?php
include 'includes/footer.php';
?>