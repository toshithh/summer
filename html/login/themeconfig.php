<?php
include "server_conn.php";
$con = mysqli_connect($db_host,$db_user,$db_pass,$_SESSION["name"]);

if (mysqli_connect_errno()) {

        exit('there was an error on our side. Have you created a database' .mysqli_connect_error());

}
?>