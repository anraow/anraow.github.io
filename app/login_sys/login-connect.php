<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login_sys';

$connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    die ('Failed connect to server: ' . mysqli_connect_error());
}

if ( !isset( $_POST[name], $_POST[password], $_POST[id], $_POST[email] )) {
    die ('Please field all');
}

if ( $stmt = $connection->prepare('SELECT name, password, email FROM users WHERE id = ?') ) {
    $stmt->bind_param('s', $_POST['id']);
    $stmt->execute();
    $stmt->store_results();
}

if( $stmt->num_rows > 0 ) {
    $stmt->bind_result($name, $password, $email);
    $stmt->fetch();

    if (password_verify($_POST['password'], $password)) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $id;
        echo 'Welcome' . $_SESSION['name'] . '!';
    } else {
        echo 'Incorrect password';
    }
} else {
    echo 'This ID does not exist';
}
$stmt->close();
?>