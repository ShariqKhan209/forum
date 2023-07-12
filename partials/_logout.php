<?php
session_start();
echo "Logging out. Please wait";
unset($_SESSION['loggedin']);
session_destroy();
header("Location: /forum/index.php");
?>