<?php
function validatePassword($password) {
    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Password should be at least 8 characters long";
    }

    elseif (!preg_match("#[0-9]+#", $password)) {
        $errors[] = "Password should contain at least one number";
    }
    
    elseif (!preg_match("#[a-zA-Z]+#", $password)) {
        $errors[] = "Password should contain at least one letter";
    } 
    
    return $errors;
}
?>


