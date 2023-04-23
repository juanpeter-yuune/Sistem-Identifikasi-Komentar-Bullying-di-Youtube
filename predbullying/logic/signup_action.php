<?php

include("config.php");
include("firebaseRDB.php");

$email = null;
$password = null;
$firstName = null;
$lastName = null;

$firstName_error = null;
$lastName_error = null;
$email_error = null;
$password_error = null;
$email_used = null;
$success_add = null;

//check incoming post form by name login on index.html
if (isset($_POST['signUp'])) {

    //save the post request, store in username and pass var
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    //Check for empty value (email or pass)
    if (empty(trim($firstName))) {
        $firstName_error = "First Name Required";
        //if theres email input then move to else check pass
    } else {
        if (empty(trim($lastName))) {
            $lastName_error = "Last Name Required";
            //if email and pass filled then display succes
        } else {
            if (empty(trim($email))) {
                $email_error = "Email Required";
            } else {
                if (empty(trim($password))) {
                    $password_error = "Password Required";
                } else {
                    $rdb = new firebaseRDB($databaseURL);
                    $retrieve = $rdb->retrieve("/user", "email", "EQUAL", $email);
                    $data = json_decode($retrieve, 1);
                    if (count($data) > 0) {
                        $email_used = "Email already used";
                    } else {
                        $insert = $rdb->insert("/user", [
                            "firstName" => $firstName,
                            "lastName" => $lastName,
                            "email" => $email,
                            "password" => $password
                        ]);
                        $success_add = 'Registrasion Successfully';
                        $result = json_decode($insert, 1);
                        header("location: ./index.php");
                    }
                }
            }


        }
    }
}

?>