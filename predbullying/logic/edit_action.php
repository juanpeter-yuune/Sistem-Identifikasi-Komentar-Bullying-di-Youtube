<?php

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
$id = $_POST['id'];
$update = $db->update("user", $id, [
    "firstName" => $_POST['firstName'],
    "lastName" => $_POST['lastName'],
    "email" => $_POST['email'],
    "password" => $_POST['password']
]);
header("location: ../user_list.php")
    ?>