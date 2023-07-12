<?php

$showError = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require '_dbconnect.php';
    $username = $_POST['username'];
    $userPassword = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $numRow = mysqli_num_rows($result);
    if($numRow==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($userPassword, $row['user_password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: /forum/index.php?loginsuccess=true");
            exit();
        }else {
        $showError = "WrongPassword";
        }
    }else{
    $showError = "WrongEmail";
    }
}
header ("Location: /forum/index.php?loginfailed=true");


?>
