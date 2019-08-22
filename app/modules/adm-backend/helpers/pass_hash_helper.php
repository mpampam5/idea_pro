<?php defined('BASEPATH') OR exit('No direct script access allowed');

function pass_encrypt($token,$str)
{
    $ecrypt = password_hash($str."".$token,PASSWORD_DEFAULT);
    return $ecrypt;
}

function pass_decrypt($token,$str,$hash)
{
    if (password_verify($str."".$token, $hash)) {
        return true;
    }
    else {
        return false;
    }
}
