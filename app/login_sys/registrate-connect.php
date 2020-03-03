<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login_sys';
// Try and connect using the info above.
$connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()){
    // If there is an error with the connection, stop the script and display the error.
    die('Failed to connect to mysql: ' . mysqli_connect_errno());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if ( !isset( $_POST['name'], $_POST['password'], $_POST['id'], $_POST['email'] )) {
    die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if ( empty($_POST['name']) || empty($_POST['id']) || empty($_POST['email']) || empty($_POST['password']) ) {
    // One or more values are empty.
    die('Please complete the registration form! - 2');    
}
// Validating and check email on existing
$email = $_POST['email'];
$stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute(); 
$user = $stmt->fetch();
if ($user) {
    die('Email уже существует');
} else {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die ('Неправильный email');
    }
}
// Validating name
if (preg_match('/[^а-Яa-zA-z-]/', $_POST['name']) == 0 || (strlen($_POST['name']) > 25)) {
    die ('Неправльное имя');
}
// Validating password
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 6) {
	die ('Пароль должен содержать от 5 до 20 символов!');
}


// We need to check if the account with that username exists.
if ($stmt = $connection->prepare('SELECT name, email, password, city, avatar, about FROM users WHERE id = ?')) {
    $stmt->bind_param('s', $_POST['id']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'ID уже существует';
    } else {
        if ($stmt = $connection->prepare('INSERT INTO users (name, id, email, password, city, about, avatar, activation_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $uniqid = uniqid();
            $stmt->bind_param('ssssssss', $_POST['name'], $_POST['id'], $email, $password, $_POST['city'], $_POST['about'], $_POST['avatar'], $uniqid);
            $stmt->execute();
            // $from    = 'registration@gmail.com';
            // $subject = 'Account Activation Required';
            // $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            // $activate_link = 'https://.../login/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
            // $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
            // mail($_POST['email'], $subject, $message, $headers);
            echo 'Аккаунт создан';
        } else {
            echo 'Ошибка';
        }
    }
    // $stmt->close();
} else {
    echo 'Ошибка';
}
$connection->close();
?>