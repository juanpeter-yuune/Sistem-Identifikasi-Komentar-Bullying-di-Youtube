<?php
function run_python_command()
{
    $urlYtb = $_POST['urlYtb'];
    $size = $_POST['size'];

    //echo "email : ".$email;
    //echo "datetime : ".$datetime;
    //echo "id : ".$id;
    //echo "size : ".$size;
    //echo "rating : ".$rating;

    print_r($_POST);

    $command = escapeshellcmd("C:/Users/HP/AppData/Local/Microsoft/WindowsApps/python.exe predictor.py $urlYtb $size");
    $output = shell_exec($command);
    echo $output;
}

# execute python
run_python_command();

?>