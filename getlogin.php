<?php

include './lib/Session.php';
Session::init();
include './lib/Database.php';
include './helpers/Format.php';

include './class/User.php';
$usr = new User();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userlogin = $usr->userLogin($email, $password);
}
?>