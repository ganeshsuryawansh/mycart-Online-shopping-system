
<?php

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

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    //$email =  $google_account_info->email;
    //$name =  $google_account_info->name;

    // now you can use this profile info to create account in your website and make user logged in.


    //echo "<a class ='btn btn-warning' href='" . $client->createAuthUrl() . "'>Login from Google </a>";
?>