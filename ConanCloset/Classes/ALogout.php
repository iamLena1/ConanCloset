<?php

session_start();

if(isset($_SESSION['ConanCloset_AID']))
{
    $_SESSION['ConanCloset_AID'] = NULL;
    unset($_SESSION['ConanCloset_AID']);
}

header("Location: ..\AdminLoginpage\AdminLoginpage.php");
?>