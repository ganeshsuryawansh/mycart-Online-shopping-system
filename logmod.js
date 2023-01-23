function forgotpass() {
    let html = document.getElementById("forgotpasid").innerHTML = `
   
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="login.php" method="post">
            <div class="form-group col-md-6">

                <label for="Username">Enter New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="" name="newpassword" required>
                </div>
            </div>


            <div class="form-group col-md-6">
                <label for="Username">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="" name="newcomformpassword" required>
                </div>
            </div>

            {{<?php
            $newpass = $_POST["newpassword"];
            $newconfpass = $_POST["newcomformpassword"];

            echo "$newpass";
            if ($newpass == $newconfpass) {
                echo "inside if";

                echo "$newconfpass";

                $useid = $_SESSION['no'];
                $pas = $newconfpass;
                //$uppass = "UPDATE `users` SET `password` = '$newconfpass' WHERE`email` = '$email'";
                $uppass = "UPDATE `users` SET `password` = '$pas' WHERE `users`.`no` = '22';";

                if (mysqli_query($conn, $uppass) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            ?>}}
            <button type="submit new password " class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</div>
</div>
    
    
    `;
}