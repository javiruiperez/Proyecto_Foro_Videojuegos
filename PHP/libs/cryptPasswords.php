<?php
    function crypt_blowfish($password) {
        $salt = '$2a$07$usesomesillystringforsalt$';
        $pass= crypt($password, $salt);

        return $pass;
    }
?>