<?php
/**
 * Created by PhpStorm.
 * User: irisb
 * Date: 24.04.2018
 * Time: 18:02
 */


class Validation
{
    //genug lange eingaben
    public function stringLenght($min, $max, $string)
    {
        if (strlen($string) >= $min && strlen($string) <= $max) {
            return true;
        } elseif (strlen($string) < $min) {
            return false;
        } elseif (strlen($string) > $max) {
            return false;
        }
    }

    public function validatePassword($password)
    {
        $isValid = false;
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        //preg_quote setzt einen Backslasch vor jedes Zeichen von "str" (1. Parameter in Methode)
        //delimiter ist der Begrenzer der ebenfalls maskiert wird.
        $pattern = preg_quote('#$%^&*()+=-[]\';,./{}|\":<>?~!', '#');
        $special = preg_match("#[{$pattern}]#", $password); // false
        if(!$uppercase)
        {
            $isValid = false;;
            $_SESSION['errors']="Passwort muss min. einen Grossbuchstaben enthalten!";
        }
        else{
            $isValid = true;
        }
        if(!$lowercase)
        {
            $isValid = false;;
            $_SESSION['errors']="Passwort muss min. einen Kleinbuchstaben enthalten!";
        }
        else{
            $isValid = true;
        }
        if(!$number)
        {
            $isValid = false;;
            $_SESSION['errors']="Passwort muss min. eine Zahl enthalten!";
        }
        else{
            $isValid = true;
        }
        if(!$special)
        {
            $isValid = false;;
            $_SESSION['errors']="Passwort muss min. ein Sonderzeichen enthalten!";
        }else{
            $isValid = true;
        }
        return $isValid;

    }



    //email validation
    public function email($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }


    public function checkExtension($extension)
    {
        if ($extension!=='jpeg' || $extension!=='png' || $extension !== 'jpg')
        {
            return true;
        }
        else{
            return false;
        }
    }


}