<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
$id = $_GET['id'];
if ($id != "") {
    $delete = $db->delete("user", "$id");
    '<script>
        alert("user Deleted");
    </script>';
    header("location: ../user_list.php");
}

?>