<?php
//session_start();
define('_HOST__NAME_', 'localhost');
define('_USER__NAME_', 'loft');
define('_DB__PASSWORD', 'zaqxswcde123');
define('_DATABASE__NAME_', 'LoftScoolDZBD');

//PDO Database Connection
try {
    $databaseConnection = new PDO('mysql:host='._HOST__NAME_.';dbname='._DATABASE__NAME_, _USER__NAME_, _DB__PASSWORD);
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected";
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>