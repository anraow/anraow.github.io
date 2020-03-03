<?php 
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login_sys';
// connect with info above
$connection = musqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    die('Failed connect to mysql: ' . mysqli_connect_error());
}
// check email and code exists
if (!isset($_GET['email'], $_GET['code'])) {
    if ($stmt = $connection->prepare('SELECT * FROM users WHERE email = ? and activation_code = ?')) {
        $stmt->bind_param('ss', $_GET['email'], $_GET['code']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            if ($stmt = $connection->prepare('UPDATE users SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
                $newcode = 'activated';
                $stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
                echo 'Your account is now activated, you can now login!<br><a href="index.html">Login</a>';
            }
        } else {
            echo 'The account is already activated or doesn\'t exist!';
        }
    }
}
?>