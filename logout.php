<?php
include_once('functions.php');
delete_cookie();
session_destroy();
header('Location: login.php');
?>