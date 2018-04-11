<?php

require_once __DIR__ . '/Medoo.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Esta classe é responsavél por toda a interaçao da Base de dados do webservice
 *
 * @author Ricardo Correia
 */
class DatabaseConnection {

    private static $userJson = 'https://portalqa.kyrioscloud.com/parishioners.json?entity_id=13723';
    private static $familyJson = 'https://portalqa.kyrioscloud.com/families.json?entity_id=13723';
    private static $catechismJson = 'https://portalqa.kyrioscloud.com/catechisms.json?entity_id=13723';
    private static $deathJson = 'https://portalqa.kyrioscloud.com/deaths.json?entity_id=13723';
    private static $massJson = 'https://portalqa.kyrioscloud.com/mass_intentions.json?entity_id=13723';
    private static $weddingJson = 'https://portalqa.kyrioscloud.com/weddings.json?entity_id=13723';
    private static $baptismJson = 'https://portalqa.kyrioscloud.com/baptisms.json?entity_id=13723';
    private static $chrismJson = 'https://portalqa.kyrioscloud.com/chrisms.json?entity_id=13723';

    /**
     * 
     * @return \Medoo\MedooInstancia a Base de dados pela framework da Medoo, pronta para ser utilizada
     */
    private static function getDb() {
        return new Medoo\Medoo(array(
            'database_type' => 'mysql',
            'database_name' => 'kyrios_database',
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
        $user = $db->select('kyriosuser', array('username', 'password', 'last_login'))[0];
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
            self::deleteFromTable('kyriosuser');
            $db = self::getDb();
            $db->insert('kyriosuser', array('username' => $username, 'password' => $password, 'last_login' => date('Y-m-d')));
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
     * Atualiza todos os dados da base de dados com os dados recebidos da API do kyrios
     */
    private static function populateDb() {
        self::populateUser();
        self::populateBaptisms();
        self::populateWeddings();
        self::populateCatechism();
        self::populateStudent();
        self::populateDeath();
        self::populateFamily();
        self::populateFamilyEntity();
        self::populateMassIntention();
        self::populateCrisma();
        self::populateChrimsEntities();
    }

    /**
     * Remove todos os dados da base de dados excepto o kyrios_user e os dados de acessos
     */
    public static function deleteDB() {
        $tables = array();
        $tables['chrisms entities'] = 'chrisms entities';
        $tables['chrism'] = 'chrism';
        $tables['mass intention'] = 'mass intention';
        $tables['family entity'] = 'family entity';
        $tables['family'] = 'family';
        $tables['death'] = 'death';
        $tables['student'] = 'student';
        $tables['catechism'] = 'catechism';
        $tables['wedding'] = 'wedding';
        $tables['baptism'] = 'baptism';
        $tables['user'] = 'user';

        foreach ($tables as $value) {
            self::deleteFromTable($value);
        }
    }

    /**
     * Elimina todos os dados da base de dados e insere os novos dados recebidos da API do Kyrios
     */
    public static function resetDB() {
        self::deleteDB();
        self::populateDb();
    }

    /**
     * Retorna a header com os dados de acesso do kyrios para enviar por curl
     * @param String $username username inserido
     * @param String $password password inserida
     * @return username em formato JSON
     */
    private static function getUserHeader($username, $password) {
        return '
{
   "user": {
        "email": "' . "$username" . '",
        "password": "' . "$password" . '"
    } 
}';
    }

    /**
     * Retorna uma substring entre um inicio e fim de outra string
     * @param string $string string para extrair a substring
     * @param String $start inicio da substring
     * @param String $end dim da substring
     * @return string retorna substring calculada
     */
    private static function get_string_between($string, $start, $end) {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    /**
     * Formula um pedido por curl á API do kyrios
     * @param String $username username inserido
     * @param String $password password inserida
     * @return String retorna a resposta da API por json
     */
    public static function getRequest($username, $password) {
        $url = 'https://portalqa.kyrioscloud.com/users/sign_in?format=json';
        $data = self::getUserHeader($username, $password);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        if ($status != 201) {
//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        return $json_response;
    }
    /**
     *  Formula um pedido curl com os dados de acesso que foram armazenados na base de dados, 
     * depois com as coockies que recebe da API do json (para poder receber os dados) faz
     * um novo pedido curl com o url que é recebido por parametro. Por fim devolve o 
     * JSON, que é recebido da API, descodificado. 
     * @param String $urlJson url para receber os dados
     * @return JSON descodificado
     */
    private static function getRequestJson($urlJson) {
        $url = 'https://portalqa.kyrioscloud.com/users/sign_in?format=json';
        $user = self::getUser();
        $data = self::getUserHeader($user['username'], $user['password']);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status != 201) {
            die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        $fullstring = $json_response;
        $xsrf = self::get_string_between($fullstring, 'XSRF-TOKEN=', '; path');
        $session = self::get_string_between($fullstring, '_session_id=', '; path=/');
        $curl = curl_init($urlJson);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: XSRF-TOKEN=" . "$xsrf", "Cookie: _session_id=" . "$session"));
        $json = curl_exec($curl);

        return json_decode($json);
    }
    /**
     * Retorna o json recebido da API relativas á ficha individuais
     * @return JSON json das fichas individuais
     */
    private static function getUserJson() {
        return json_encode(self::getRequestJson(self::$userJson));
    }

    /**
     * Intruduz dados recebidos da API na base de dados
     */
    private static function populateUser() {

        $db = self::getDb();

        $json = self::getUserJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getUsers(array('id' => $value['id'])))) {
                $array = array(
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'entity__birth_date' => $value['entity__birth_date'],
                    'entity__is_parishioner' => $value['entity__is_parishioner'],
                    'entity_elder__elder' => $value['entity_elder__elder'],
                    'entity_elder__sick' => $value['entity_elder__sick']);
                $db->insert('user', $array);
            }
        }
    }

    /**
     * Retorna o json recebido da API relativos aos batismos
     * @return JSON json dos batismos
     */
    private static function getBaptismsJson() {
        return json_encode(self::getRequestJson(self::$baptismJson));
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateBaptisms() {
        $db = self::getDb();
        $json = self::getBaptismsJson();
        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getBaptisms(array('id' => $value['id'])))) {
                $array = array(
                    'id' => $value['id'],
                    'baptism_date' => $value['baptism_date'],
                    'date' => $value['date'],
                    'entity_description' => $value['entity_description'],
                    'curia_status' => $value['curia_status']);
                $db->insert('baptism', $array);
            }
        }
    }

    /**
     * Retorna o json recebido da API relativos aos casamentos
     * @return JSON json dos casamentos
     */
    private static function getWeddingsJson() {
        return json_encode(self::getRequestJson(self::$weddingJson));
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateWeddings() {
        $db = self::getDb();
        $json = self::getWeddingsJson();
        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getWeddings(array('id' => $value['id'])))) {
                $array = array(
                    'id' => $value['id'],
                    'entity_bride_id' => $value['entity_bride_id'],
                    'date' => $value['date'],
                    'entity_groom_id' => $value['entity_groom_id'],
                    'wedding_date' => $value['wedding_date'],
                    'curia_status' => $value['curia_status']);
                $db->insert('wedding', $array);
            }
        }
    }

    /**
     * Retorna o json recebido da API relativas das catequeses
     * @return JSON json das catequeses
     */
    private static function getCatechismJson() {
        return json_encode(self::getRequestJson(self::$catechismJson));
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateCatechism() {

        $db = self::getDb();

        $json = self::getCatechismJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getCatechisms(array('id' => $value['id'])))) {
                $array = array(
                    'catechist_description' => $value['catechist_description'],
                    'class_year' => $value['class_year'],
                    'finalized' => $value['finalized'],
                    'id' => $value['id'],
                    'is_for_adults' => $value['is_for_adults'],
                    'name' => $value['name'],
                    'start_time' => $value['start_time'],
                    'week_day' => $value['week_day']);
                $db->insert('catechism', $array);
            }
        }
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateStudent() {

        $db = self::getDb();

        $json = self::getCatechismJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);

            if (isset($value["catechisms_students_attributes"])) {
                foreach ($value["catechisms_students_attributes"] as $student) {
                    $student = get_object_vars($student);
                    if (empty(self::getStudents(array('id' => $value['id'])))) {
                        $array = array(
                            'education_sponsor_id' => $student['education_sponsor_id'],
                            'entity_id' => $student['entity_id'],
                            'id' => $student['id'],
                            'inscription_date' => $student['inscription_date'],
                            'observations' => $student['observations'],
                            'catechism_id' => $student['catechism_id']);
                        $db->insert('student', $array);
                    }
                }
            }
        }
    }

    /**
     * Retorna o json recebido da API relativos aos obitos
     * @return JSON json dos obitos
     */
    private static function getDeathsJson() {
        return json_encode(self::getRequestJson(self::$deathJson));
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateDeath() {

        $db = self::getDb();

        $json = self::getDeathsJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getDeaths(array('id' => $value['id'])))) {
                $array = array(
                    'bury_chapelry_description' => $value['bury_chapelry_description'],
                    'death_date' => $value['death_date'],
                    'death_hour' => $value['death_hour'],
                    'death_chapelry_description' => $value['death_chapelry_description'],
                    'entity_bury_cemitery' => $value['entity_bury_cemitery'],
                    'entity_bury_date' => $value['entity_bury_date'],
                    'entity_death_county' => $value['entity_death_county'],
                    'entity_death_locality' => $value['entity_death_locality'],
                    'entity_death_place' => $value['entity_death_place'],
                    'entity_id' => $value['entity_id'],
                    'id' => $value['id'],
                    'observations' => $value['observations']);
                $db->insert('death', $array);
            }
        }
    }

    /**
     * Retorna o json recebido da API relativas as familias
     * @return JSON json das familias
     */
    private static function getFamilyJson() {
        return json_encode(self::getRequestJson(self::$familyJson));
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateFamily() {
        $db = self::getDb();

        $json = self::getFamilyJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getFamilies(array('id' => $value['id'])))) {
                $array = array(
                    'father_id' => $value['father_id'],
                    'mother_id' => $value['mother_id'],
                    'name' => $value['name'],
                    'comments' => $value['comments'],
                    'created_at' => $value['created_at'],
                    'id' => $value['id'],
                    'opt1_text' => $value['opt1_text'],
                    'opt1_text2' => $value['opt1_text2'],
                    'opt1_text2_description' => $value['opt1_text2_description'],
                    'opt2_text' => $value['opt2_text'],
                    'opt2_text2' => $value['opt2_text2'],
                    'opt3_text' => $value['opt3_text'],
                    'opt4_text' => $value['opt4_text'],
                    'opt5_text' => $value['opt5_text']);
                $db->insert('family', $array);
            }
        }
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateFamilyEntity() {

        $db = self::getDb();

        $json = self::getFamilyJson();

        $records = json_decode($json);
        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            foreach ($value["families_entities"] as $entity) {
                $entity = get_object_vars($entity);
                if (empty(self::getFamilyEntities(array('id' => $value['id'])))) {
                    $array = array(
                        'family_id' => $entity["family_id"],
                        'entity_id' => $entity['entity_id'],
                        'relation_with' => $entity['relation_with'],
                        'entity_type' => $entity['relationship_degree_description'],
                        'id' => $entity['id']);
                    $db->insert('family entity', $array);
                }
            }
        }
    }

    /**
     * Retorna o json recebido da API relativas ás missas
     * @return JSON json das missas
     */
    private static function getMissaIntentionJson() {
        return json_encode(self::getRequestJson(self::$massJson));
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateMassIntention() {

        $db = self::getDb();

        $json = self::getMissaIntentionJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getMass(array('id' => $value['id'])))) {
                $array = array(
                    'celebrated_by_id' => $value['celebrated_by_id'],
                    'comments' => $value['comments'],
                    'id' => $value['id'],
                    'intention_date' => $value['intention_date'],
                    'intention_description' => $value['intention_description'],
                    'intention_time' => $value['intention_time'],
                    'location' => $value['location_description'],
                    'paid' => $value['paid'],
                    'type_name' => $value['type_name']);
                $db->insert('mass intention', $array);
            }
        }
    }

    /**
     * Retorna o json recebido da API relativos aos crismas
     * @return JSON json dos crismas
     */
    private static function getCrismaJson() {
        return json_encode(self::getRequestJson(self::$chrismJson));
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateCrisma() {

        $db = self::getDb();

        $json = self::getCrismaJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);
            if (empty(self::getChrisms(array('id' => $value['id'])))) {
                $array = array(
                    'date' => $value['date'],
                    'entity_chrism_location_description' => $value['entity_chrism_location_description'],
                    'entity_rel_mec_description' => $value['entity_rel_mec_description'],
                    'id' => $value['id']);
                $db->insert('chrism', $array);
            }
        }
    }

    /**
     * Introduz dados recebidos da API na base de dados
     */
    private static function populateChrimsEntities() {

        $db = self::getDb();

        $json = self::getCrismaJson();

        $records = json_decode($json);

        foreach ($records->results as $value) {
            $value = get_object_vars($value);

            foreach ($value["chrisms_entities_attributes"] as $chism) {
                $chism = get_object_vars($chism);
                if (empty(self::getChrismsEntities(array('id' => $value['id'])))) {
                    $array = array(
                        'entity_id' => $chism['entity_id'],
                        'godfather_godmother_id' => $chism['godfather_godmother_id'],
                        'id' => $chism['id'],
                        'chrism_id' => $chism['chrism_id'],
                        'tax' => $chism['tax']);
                    $db->insert('chrisms entities', $array);
                }
            }
        }
    }

    /**
     * Devolve os casamentos da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getWeddings($where) {
        return self::getDb()->select('wedding', array('id', 'date', 'entity_bride_id', 'entity_groom_id',
                    'wedding_date', 'curia_status'), $where);
    }

    /**
     * Devolve os batismos da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getBaptisms($where) {
        return self::getDb()->select('baptism', array('id', 'baptism_date', 'date', 'entity_description',
                    'curia_status'), $where);
    }

    /**
     * Devolve as catequeses da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getCatechisms($where) {
        return self::getDb()->select('catechism', array('catechist_description',
                    'class_year', 'finalized', 'id',
                    'is_for_adults', 'name', 'start_time', 'week_day'), $where);
    }

    /**
     * Devolve os crismas da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getChrisms($where) {
        return self::getDb()->select('chrism', array('id', 'entity_chrism_location_description',
                    'date', 'entity_rel_mec_description'), $where);
    }

    /**
     * Devolve as pessoas que estão inscritas para o crisma da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getChrismsEntities($where) {
        return self::getDb()->select('chrisms entities', array('entity_id', 'godfather_godmother_id',
                    'id', 'chrism_id', 'tax'), $where);
    }

    /**
     * Devolve os obitos da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getDeaths($where) {
        return self::getDb()->select('death', array('bury_chapelry_description', 'death_date',
                    'death_hour', 'death_chapelry_description', 'entity_bury_cemitery',
                    'entity_bury_date', 'entity_death_county', 'entity_death_locality',
                    'entity_death_place', 'entity_id', 'id', 'observations'), $where);
    }

    /**
     * Devolve as familias da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getFamilies($where) {
        return self::getDb()->select('family', array('father_id', 'mother_id',
                    'name', 'comments', 'created_at',
                    'id', 'opt1_text', 'opt1_text2',
                    'opt1_text2_description', 'opt2_text', 'opt2_text2', 'opt3_text',
                    'opt4_text', 'opt5_text'), $where);
    }

    /**
     * Devolve as pessoas pertencentes á familia da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getFamilyEntities($where) {
        return self::getDb()->select('family entity', array('family_id', 'entity_id',
                    'relation_with', 'entity_type', 'id'), $where);
    }

    /**
     * Devolve as missas da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getMass($where) {
        return self::getDb()->select('mass intention', array('celebrated_by_id', 'comments',
                    'id', 'intention_date', 'intention_description',
                    'intention_time', 'location', 'paid',
                    'type_name'), $where);
    }

    /**
     * Devolve os estudantes de uma catequese da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getStudents($where) {
        return self::getDb()->select('student', array('education_sponsor_id', 'entity_id',
                    'id', 'inscription_date', 'observations',
                    'catechism_id'), $where);
    }

    /**
     * Devolve os paroquianos da base de dados
     * @param array $where array chave valor em que a chave é o nome da tabela e o valor
     * é o filtro para obter os dados da tabela
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getUsers($where) {
        return self::getDb()->select('user', array('id', 'name',
                    'entity__birth_date', 'entity_elder__elder', 'entity__is_parishioner',
                    'entity_elder__sick'), $where);
    }

    /**
     * Devolve o ultimo utilizador a estar logado
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getKyriosUser($where) {
        return self::getDb()->select('kyriosuser', array('id', 'username',
                    'password', 'last_login'), $where);
    }

    /**
     * Devolve os acessos no webservice
     * @return array array chave valor em que a chave é o nome da tabela e o valor é o seu valor
     */
    public static function getLogins() {
        return self::getDb()->select('login', array('date', 'user'), array());
    }

}
