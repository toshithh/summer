<?php
$simple_string = $_POST["password"];
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '6969969699696900';
$encryption_key = "toshith";


$encpassword = openssl_encrypt($simple_string, $ciphering,
            $encryption_key, $options, $encryption_iv);
?>