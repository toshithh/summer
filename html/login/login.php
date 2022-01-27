<?php
session_start();
if (isset($_SESSION['loggedin'])) {

    header('Location: /widescreen/login/home.php');

    exit;

}
include "server_conn.php";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_login);
if ( mysqli_connect_errno() ) {

        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
include "enc_pass.php";
if ( !isset($_POST['username'], $encpassword) ) {
        exit('Please fill both the username and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, firstname, sex, password FROM users WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $fname, $sex, $password);
        $stmt->fetch();

        if ($encpassword === $password) {

            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['fname'] = $fname;
            $_SESSION['sex'] = $sex;
            $_SESSION['password'] = $encpassword;
            header('LOCATION: home.php');
        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
        }
    } else {
        echo 'user does not exist';
    }

        $stmt->close();
}
?>