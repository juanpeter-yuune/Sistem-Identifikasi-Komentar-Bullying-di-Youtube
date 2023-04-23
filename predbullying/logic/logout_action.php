<?php
include("config.php");
include("firebaseRDB.php");

if (isset($_SESSION['user'])) {
    unset($SESSION['user']);
}

header("location: ../index.php ")
    ?>