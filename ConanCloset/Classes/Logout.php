<?php

session_start();

if(isset($_SESSION['ConanCloset_ID']))
{
    $_SESSION['ConanCloset_ID'] = NULL;
    unset($_SESSION['ConanCloset_ID']);
}

header("Location: ..\UserLoginpage\UserLoginpage.php");
?>