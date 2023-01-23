<?php

include 'includes/nav.php';
include 'includes/dbconnect.php';

?>

<div class="container my-5">
    <h4>Forgot password</h4>
    <form action="password_reset_code.php" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <button type="submit" name="password_reset_link" class="btn btn-primary">Send Password Reset Link</button>
    </form>
</div>


