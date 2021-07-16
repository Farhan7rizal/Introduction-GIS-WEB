<?php
ob_start();
session_start();
$dsn = "pgsql:host=localhost;dbname=webmap302;port=5432";
$opt = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      => false
];
$pdo = new PDO($dsn, 'postgres', 'Farhan7', $opt);
// echo "Connected to Database!!!";

$root_directory = "SINI/Introduction GIS WEB/webmap302";
$from_email = "Farhan48rizal@gmail.com";
$reply_email = "Farhan48rizal@gmail.com";
include "php_functions.php";
