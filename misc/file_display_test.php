<?php
session_start();
include('../lib/config.php');
include('../lib/db.class.php');
include('../include_classes.php');
include('../functions.php');

ini_set('display_errors',0);
error_reporting(E_ALL);

$db = new Db($dbConfig);


?>

<!DOCTYPE html>

<html>

<head>

</head>

<body>

<?php
    $query = "SELECT * FROM files";
    $files = $db->runQuery($query);

    foreach ($files as $file) {
        echo "<img src=". $file['link'] ."></img>";
    }
?>

</body>
</html>