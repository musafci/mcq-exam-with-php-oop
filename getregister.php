<?php

include './lib/Session.php';
Session::init();
include './lib/Database.php';
include './helpers/Format.php';


include './class/User.php';
$usr = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $userreg = $usr->userRegistration($name, $username, $password, $email);
}
?>