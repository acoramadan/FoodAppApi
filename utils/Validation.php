<?php
function isEmptyRegister($email,$username,$password,$phone_number) {
    if(empty($email) || empty($username) || empty($password) || empty($phone_number)) {
        return true;
    } else {
        return false;
    } 
}

function isEmptyLogin($email,$password) {
    if(empty($email) || empty($password)) {
        return true;
    } else {
        return false;
    }
}
function isEmptyPasswordAndEmail($password,$email) {
    if(empty($password) || empty($email)) {
        return true;
    } else {
        return false;
    }
}
function isEmptyPassword($password) {
    if(empty($password)) {
        return true;
    } else {
        return false;
    }
}