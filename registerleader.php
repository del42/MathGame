<?php

include_once 'db/leader.php';

$email = $_POST['email'];
$fName = $_POST['firstname'];
$lName = $_POST['lastname'];
$passwd = $_POST['pwd'];
$title = $_POST['title'];
$sName = $_POST['sName'];
$city = $_POST['city'];
$state = $_POST['State'];

Leader::registerLeader($fName, $lName, $title, $email, $passwd, $sName, $city, $state);
 
?>
