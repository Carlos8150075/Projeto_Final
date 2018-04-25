<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Config {
    
    
    const SGBD_HOST_NAME = 'localhost';
    const SGBD_DATABASE_NAME = 'projeto_final';
    const SGBD_USERNAME = 'root';
    const SGBD_PASSWORD = '';
    
    
    const CRYPT_CODE = '15976452';
    
    
    public static function getApplicationPath(){
        return realpath(dirname( __FILE__ )) . '/assets/';
    }
    
    public static function getApplicationModelPath(){
        return self::getApplicationPath() . '/Model/';
    }
    
    public static function getApplicationDatabasePath(){
        return self::getApplicationPath() . '/Database/';
    }
    
    public static function getApplicationValidatorPath(){
        return self::getApplicationPath() . '/Validator/';
    }
    
    public static function getApplicationManagerPath(){
        return self::getApplicationPath() . '/Management/';
    }
    public static function getApplicationServicesPath(){
        return self::getApplicationPath() . '/Services/';
    }
    public static function getApplicationFunctionPath(){
        return self::getApplicationPath() . '/Functions/';
    }
}


