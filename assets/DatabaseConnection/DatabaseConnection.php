<?php

require_once __DIR__ . '/Medoo.php';
require_once __DIR__ . '/../../Config.php';

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

      public static function getUser() {
      $db = self::getDb();
      $user = $db->select('users_login', array('username', 'password', 'last_login'))[0];
      return $user;
      }/*

      /**
     * Introduz na Base de dados um novo utilizador a estar logado
     * @param String $username username do novo utilizador
     * @param String $password password do novo utilizador
     */
    public static function setLogins($username, $password) {
        /* $user = self::getUser();
          if ($username === $user['username'] && $password === $user['password']) {
          $last_login = $user['last_login'];
          $today = date('Y-m-d');
          if (strtotime($last_login . '+1 day') >= $today) {
          //self::resetDB();
          }
          } else {
          self::deleteFromTable('users_login'); */
        $db = self::getDb();
        $db->insert('users_login', array('username' => $username, 'password' => $password, 'last_login' => date('Y-m-d')));
        //self::resetDB();
        //  }
    }

    /**
     * Introduz na Base de dados um novo utilizador a estar logado
     * @param String $username username do novo utilizador
     * @param String $password password do novo utilizador
     */
    public static function setUsers($username, $surname, $email, $password, $regiao) {
        /* $user = self::getUser();
          if ($username === $user['username'] && $password === $user['password']) {
          $last_login = $user['last_login'];
          $today = date('Y-m-d');
          if (strtotime($last_login . '+1 day') >= $today) {
          //self::resetDB();
          }
          } else {
          self::deleteFromTable('users_login'); */
        $db = self::getDb();
        $new_password = crypt($password, Config::CRYPT_CODE);
        $db->insert('users', array('name' => $username, 'surname' => $surname, 'email' => $email, 'password' => $new_password, 'regiao' => $regiao));
        //self::resetDB();
        //  }
    }

    /**
     * 
     * @param type $username
     * @param type $utilitie
     * @param type $valor
     * @param type $date
     */
    public static function addRegistos($username, $utility, $valor, $date) {

        $db = self::getDb();
        $db->insert('registo', array('id_user' => $username, 'id_utility' => $utility, 'valor' => $valor, 'date' => $date));
        //self::resetDB();
        //  }
    }
    
    public static function deleteUser($id) {

        $db = self::getDb();
        $db->delete('users', array('id' => $id));
        
    }
    
     public static function deleteUtilitie($id) {

        $db = self::getDb();
        $db->delete('utilities', array('id' => $id));
        
    }
    
    public static function deleteRegisto($id) {
        

        $db = self::getDb();
        $db->delete('registo', array('id' => $id));
        //self::resetDB();
        //  }
    }
    
    public static function updateAmbiente($id,$novo) {
        

        $db = self::getDb();
        $db->delete('registo', array('id' => $id));
        //self::resetDB();
        //  }
    }
    
    
     public static function addAmbientesIniciais($id_user) {
         $nome1="Ambiente 1";
         $nome2="Ambiente 2";
         $nome3="Ambiente 3";
         $nome4="Ambiente 4";
                 
                 
        $db = self::getDb();
        $db->insert('ambientes', array('name' => $nome1, 'id_user' => $id_user));
        $db->insert('ambientes', array('name' => $nome2, 'id_user' => $id_user));
        $db->insert('ambientes', array('name' => $nome3, 'id_user' => $id_user));
        $db->insert('ambientes', array('name' => $nome4, 'id_user' => $id_user));
        //self::resetDB();
        //  }
    }
    

    public static function addUtility($ambiente, $name, $metric, $user) {

        $db = self::getDb();
        
      

        $db->insert('utilities', array( 'id_ambiente' => $ambiente, 'name' => $name, 'metric' => $metric, 'id_user' => $user));

        //self::resetDB();
        //  }
    }
    
    public static function encontrarAmbiente( $name, $user) {

         $db = self::getDb();

        $query = ("SELECT * FROM ambientes WHERE name='$name' AND $user");
        $data = $db->exec($query)->fetchAll();


        return $data[0]['id'];
    }
    
    public static function atualizarAmbiente( $id) {

         $db = self::getDb();

        $query = ("SELECT * FROM ambientes WHERE name='$id'");
        $data = $db->exec($query)->fetchAll();


        return $data[0]['id'];
    }
    
    
    

    public static function getUserByEmail($email) {

        $db = self::getDb();

        $query = ("SELECT * FROM users WHERE email='$email'");
        $data = $db->exec($query)->fetchAll();


        return $data[0]['id'];
    }
    
    
     public static function getLevelByEmail($email) {

        $db = self::getDb();

        $query = ("SELECT * FROM users WHERE email='$email'");
        $data = $db->exec($query)->fetchAll();


        return $data[0]['level'];
    }
    
    

    public static function getNomeByEmail($email) {

        $db = self::getDb();

        $query = ("SELECT * FROM users WHERE email='$email'");
        $data = $db->exec($query)->fetchAll();


        return $data[0]['name'];
    }

    public static function getUtilityByID($id) {

        $db = self::getDb();

        $query = ("SELECT * FROM utilities WHERE id='$id'");
        $data = $db->exec($query)->fetchAll();


        return $data[0]['name'];
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
        return self::getDb()->select('users', array('id', 'name', 'surname', 'email', 'password', 'regiao', 'level', 'foto'), $where);
    }

    /**
     * 
     * @param type $where
     * @return type
     */
    public static function getAmbientes($where) {
        return self::getDb()->select('ambientes', array('id', 'name','id_user'), $where);
    }

    /**
     * 
     * @param type $where
     * @return type
     */
    public static function getPeriodo($where) {
        return self::getDb()->select('periodo', array('id', 'id_utility', 'start', 'end', 'price'), $where);
    }

    /**
     * 
     * @param type $where
     * @return type
     */
    public static function getRegistos($where) {
        return self::getDb()->select('registo', array('id', 'id_user', 'id_utility', 'valor', 'date'), $where);
    }

    /**
     * Devolve as utilities da base de dados
     * @param type $where
     * @return type
     */
    public static function getUtilities($where) {
        return self::getDb()->select('utilities', array('id', 'id_ambiente', 'name', 'metric', 'id_user'), $where);
    }

    /**
     * verify if user exist
     * @param string $email email of user
     * @return boolean 
     */
    public function existUser($email) {
        $db = self::getDb();

        $query = ("SELECT * FROM users WHERE email='$email'");
        $data = $db->exec($query)->fetchAll();
        if (isset($data[0])) {
            ////  echo 'existe';
            return $data[0];
        } else {
            // echo 'nao existe';
            return FALSE;
        }
    }

    /**
     * verify match from email and password
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function validateUser($email, $password) {
        if (self::existUser($email) != FALSE) {
            echo 'true';
            $user = self:: existUser($email);
            // print_r($user);
            //echo $password;
            return ($password === $user['password']);
        } else {
            echo 'false';
            return false;
        }
    }

}
