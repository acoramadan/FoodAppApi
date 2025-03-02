<?php

function generateIdEncrpyt($id) {
    $generateId = openssl_encrypt($id, "AES-128-ECB", "1234567890123456");
    return $generateId;
}