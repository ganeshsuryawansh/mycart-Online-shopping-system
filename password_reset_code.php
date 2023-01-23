<?php
session_start();

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(1);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();


    //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ganeshsuryawanshi594@gmail.com', $get_name);
    $mail->addAddress($get_email);     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';

    //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $email_template =`
    <h2>Hello</h2>
    <h3>You have receved this email because password reset request for your account </h3>
    <br><br>
    <a href='http://localhost/ecommerce/password_change.php?token=$token&email=$get_email'> Click Me </a>
    `;
    $mail->Body =$email_template;
    $mail->send();
}

if (isset($_POST['password_reset_link'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email ='$email'LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {

        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['username'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token ='$token' WHERE email ='$get_email'LIMIT 1 ";
        $update_token_run = mysqli_query($conn, $update_token);

        if ($update_token_run) {

            send_password_reset($get_name, $get_email, $token);
            $_SESSION['status'] = "we email you password reset link ";
            header("Location: forgot_pass_sample.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Something went Wrong";
            header("Location: forgot_pass_sample.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "NO Email Found";
        header("Location: forgot_pass_sample.php");
        exit(0);
    }
}
/*
if (isset($_POST['submit'])) {
    // Connect to the database

    // Get the email address
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email address exists in the database
    $query = "SELECT * FROM users WHERE email ='$email'";
    $results = mysqli_query($conn, $query);

    if (mysqli_num_rows($results) > 0) {
        // Generate a random password reset token
        $token = bin2hex(random_bytes(16));

        // Save the token to the database
        $query = "UPDATE users SET reset_token='$token', reset_token_expiration=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
        mysqli_query($conn, $query);

        // Send the password reset email
        $to = $email;
        $subject = 'Password Reset';
        $message = 'Click this link to reset your password: http://localhost/ecommerce/reset-password.php?token=' . $token;
        $headers = 'From: noreply@mycart.com';
        mail($to, $subject, $message, $headers);

        // Show a message that the email was sent
        echo 'An email was sent to ' . $email . ' with a link to reset your password.';
    } else {
        echo 'No account with that email address was found.';
    }
}
*/
