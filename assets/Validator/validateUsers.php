<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../../Config.php';

class ValidateUser {

    public static function validadeEmail($email) {
        return !(!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !filter_var($email, FILTER_SANITIZE_EMAIL) || strlen($email) > 50);
    }

    public static function validatePassword($password) {
        return !(strlen($password) > 50 || !filter_var($password, FILTER_SANITIZE_STRING) || strlen($password) < 3);
    }

    public static function validateMatch($email, $password) {
        $m = new DatabaseConnection();
        return $m->validateUser($email, $password);
    }

    public static function validateLogin($email, $password) {
        $errors = array();
        if (!self::validadeEmail($email)) {
            $errors['email'] = "Erro Email!";
        }
        if (!self::validatePassword($password)) {
            $errors['password'] = "Erro Password!";
        } else {
            $password = crypt($password, Config::CRYPT_CODE);
        }

        if (!self::validateMatch($email, $password)) {
            $errors['user'] = "Utilizador não existe ou palavra-passe errada!";
        }


        return $errors;
    }

    public static function validateName($name) {
        return !(strlen($name) > 50 || !filter_var($name, FILTER_SANITIZE_STRING) || strlen($name) < 3);
    }

    public static function validateNewEmail($email) {
        $um = new DatabaseConnection();
        if ($um->existUser($email) != FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function validadeSignin($email, $password, $password2, $name, $surname) {
        $errors = array();
        if (!self::validadeEmail($email)) {
            $errors['email'] = "Erro Email!";
        }
        if (!self::validatePassword($password)) {
            $errors['password'] = "Erro Password!";
        }
        if (!self::validateName($name)) {
            $errors['name'] = "Erro Primeiro Nome!";
        }
        if (!self::validateName($surname)) {
            $errors['surname'] = "Erro Ultimo Nome!";
        }
        if ($password !== $password2) {
            $errors['passwords'] = "Passwords não condizem!";
        }
        if (self::validateNewEmail($email)) {
            $errors['user'] = 'Email já existe!';
        }

        return $errors;
    }

}
