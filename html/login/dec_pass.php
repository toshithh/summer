<?php
$simple_string = $enspassword;
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$decryption_iv = '6969969699696900';
$decryption_key = "toshith";


$password = openssl_decrypt($simple_string, $ciphering,
            $decryption_key, $options, $decryption_iv);
?>