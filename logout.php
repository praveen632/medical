<?php
include('include/includes.php');
unset($_SERVER['user_data']);
session_destroy();
header('location:login.php');
?>