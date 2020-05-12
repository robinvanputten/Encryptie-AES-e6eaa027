<?php
function encrypt_aes128gcm($plaintext, $key) {
    $cipher = "aes-128-gcm";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
    return [$ciphertext, $iv, $tag];
}

function decrypt_aes128gcm($ciphertext, $key, $iv, $tag) {
    $cipher = "aes-128-gcm";
    $ivlen = openssl_cipher_iv_length($cipher);
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
    return $original_plaintext;
}

$encryptionkey = "supersecretkey";
$encryptedtext = encrypt_aes128gcm("test", $encryptionkey);
print_r($encryptedtext);
echo decrypt_aes128gcm($encryptedtext[0], $encryptionkey, $encryptedtext[1], $encryptedtext[2]) . PHP_EOL;
?>