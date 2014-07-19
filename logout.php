<?php
include_once('functions.php');
include('include_classes.php');
c_cookie::delete_cookie();
session_destroy();
header('Location: login.php');
?>