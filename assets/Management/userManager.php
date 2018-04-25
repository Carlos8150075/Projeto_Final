<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class userManager extends DatabaseConnection{
    
    public function validateUser($email, $password) {
        if (self::existUser($email)) {
            $user = self::getUser($email);
            return ($password === $user['password']);
        } else {
            return false;
        }
    }
    
    
}
