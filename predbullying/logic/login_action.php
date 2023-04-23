<?php
include("config.php");
include("firebaseRDB.php");

//initialize variabel that using in this code
$email = null;
$email_error = null;
$password = null;
$password_error = null;
$email_not_regis = null;
$password_not_match = null;



//check incoming post form by name login on index.html
if (isset($_POST['login'])) {

    //save the post request, store in username and pass var
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Check for empty value (email or pass)
    if (empty(trim($email))) {
        $email_error = "Email Required";
        //if theres email input then move to else check pass
    } else {
        if (empty(trim($password))) {
            $password_error = "Password Required";
            //if email and pass filled then display succes
        } else {
            $rdb = new firebaseRDB($databaseURL);
            $retrieve = $rdb->retrieve("/user", "email", "EQUAL", $email);
            $data = json_decode($retrieve, 1);

            if (count($data) == 0) {
                $email_not_regis = "Your email not registered";
            } else {
                $id = array_keys($data)[0];
                if ($data[$id]['password'] == $password and $data[$id]['email'] == "predbullying.system@gmail.com") {
                    $_SESSION['user'] = $data[$id];
                    header("location: dashboard.php");
                } else if ($data[$id]['password'] == $password) {
                    $_SESSION['user'] = $data[$id];
                    header("location: home.php");
                } else {
                    $password_not_match = "Invalid Password";
                }
            }

        }
    }
}