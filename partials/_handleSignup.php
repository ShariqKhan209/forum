<?php

$showError = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $username = $_POST['username'];
    $user_password = $_POST['signupPassword'];
    $user_cpassword = $_POST['signupcPassword'];

    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email' or username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $row = mysqli_num_rows($result);
    if($row > 0){
        $showError = "Email or username already in use";
    }
    else 
    if ($user_password == $user_cpassword){
        $hash = password_hash($user_password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`user_email`, `username`, `user_password`, `timestamp`) VALUES ('$user_email', '$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showSuccessAlert = true;
        header ("Location: /forum/index.php?signupsuccess=true");
        exit();
    }
    else{
        $showError = "Passwords do not match";
    }
    header ("Location: /forum/index.php?signupsuccess=false&error=$showError");

}

?>