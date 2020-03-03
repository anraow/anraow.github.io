<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'post_sys';

$connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    die('Failed to connect to mysql: ' . mysqli_connect_errno());
}

if ( !isset($_POST['photos'], $_POST['title'], $_POST['place'], $_POST['date'], $_POST['description'], $_POST['price'])) {
    die('Please complete all forms!');
}

if ( empty($_POST['photos']) || empty($_POST['title']) || empty($_POST['place']) || empty($_POST['date']) || empty($_POST['description']) || empty($_POST['price']) ) {
    die('Please complete all forms!');
}


?>