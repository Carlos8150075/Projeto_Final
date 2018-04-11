<?php

require_once __DIR__ . '/Medoo.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DatabaseConnection {
    
    /**
     * 
     * @return \Medoo\MedooInstancia a Base de dados pela framework da Medoo, pronta para ser utilizada
     */
    private static function getDb() {
        return new Medoo\Medoo(array(
            'database_type' => 'mysql',
            'database_name' => 'projeto_final',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ));
    }

    /**
     * Remove todos os dados de uma tabela
     * @param String $table tabela para ter os seus dados removidos
     */
    private static function deleteFromTable($table) {
        $db = self::getDb();
        $sql = 'DELETE FROM ';
        $db->exec("" . $sql . "`" . $table . "`");
        echo '<br>';
    }
    
     /**
     * Retorna ultimo utilizador a estar logado
     * @return array(chave -> valor) retorna ultimo utilizador a estar logado
     */
    public static function getUser() {
        $db = self::getDb();
        $user = $db->select('users_login', array('username', 'password', 'last_login'))[0];
        return $user;
    }

    /**
     * Introduz na Base de dados um novo utilizador a estar logado
     * @param String $username username do novo utilizador
     * @param String $password password do novo utilizador
     */
    public static function setUser($username, $password) {
        $user = self::getUser();
        if ($username === $user['username'] && $password === $user['password']) {
            $last_login = $user['last_login'];
            $today = date('Y-m-d');
            if (strtotime($last_login . '+1 day') >= $today) {
                self::resetDB();
            }
        } else {
            self::deleteFromTable('users_login');
            $db = self::getDb();
            $db->insert('users_login', array('username' => $username, 'password' => $password, 'last_login' => date('Y-m-d')));
            self::resetDB();
        }
    }
    
    /**
     * Adiciona um novo login á base de dados
     * @param String $name username de quem fez acesso no website
     */
    public static function addAccess($name) {
        $date = date("Y-m-d");
        $db = self::getDb();
        $db->insert('login', array('date' => $date, 'user' => $name));
    }
    
    
    /**
     * Remove todos os dados da base de dados excepto o users_login e os dados de acessos
     */
    public static function deleteDB() {
        $tables = array();
        $tables['login'] = 'login';
        $tables['users'] = 'users';
        $tables['utilities'] = 'utilities';
        
        foreach ($tables as $value) {
            self::deleteFromTable($value);
        }
    }
    
    /**
     * Devolve os acessos no webservice
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getLogins() {
        return self::getDb()->select('login', array('date', 'user'), array());
    }
    
    
    /**
     * Devolve o ultimo utilizador a estar logado
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getUsers_login($where) {
        return self::getDb()->select('users_login', array('id', 'username',
                    'password', 'last_login'), $where);
    }
    
    /**
     * Devolve os utilizadores da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getUsers($where) {
        return self::getDb()->select('users', array('id', 'name','foto'), $where);
    }
    
    /**
     * Devolve as utilities da base de dados
     * @param type $where
     * @return type
     */
     public static function getUtilities($where) {
        return self::getDb()->select('utilities', array('id', 'name','quantity','metric','day','month','year'), $where);
    }

}
