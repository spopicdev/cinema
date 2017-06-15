<?php
include('db_config.php');
$error='';
session_start();
if (isset($_POST['submit'])) {


    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Unesite login parametre";
        header('Location: login.php');
    }
    else {

        $username=$_POST['username'];
        $password=$_POST['password'];
        //sql injection preventiva
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = trim(mysqli_real_escape_string($connection, $_POST['username']));
        $password = trim(mysqli_real_escape_string($connection, $_POST['password']));

        // query
        $sql = "SELECT * FROM administrator WHERE username='$username' AND password='$password'";

        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) == 1)
        {
            $_SESSION['username']=$username;
            mysqli_free_result($result);
            mysqli_close($connection);
            header('Location: admin.php');
        } else {
            $error="Neispravni login podaci";
            header('Location: login.php');

        }
        mysqli_close($connection);

    }
} else echo $error;


?>