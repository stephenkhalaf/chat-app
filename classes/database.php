<?php

define('DBUSER', 'khalaf');
define('DBPASS', 'royaldiva');

class Database
{
    private $conn;

    function __construct()
    {
        $this->conn = $this->connect();
    }

    private function connect()
    {
        $string = "mysql:host=localhost;dbname=mychat_db";
        try {
            $connection = new PDO($string, DBUSER, DBPASS);
            return $connection;
        } catch (PDOException $err) {
            echo $err->getMessage();
            die('pdo error');
        }
    }

    public function write($query, $data_array = [])
    {
        $conn = $this->connect();
        $statement = $conn->prepare($query);
        $check =  $statement->execute($data_array);
        if ($check) return true;

        return false;
    }

    public function read($query, $data_array = [])
    {
        $conn = $this->connect();
        $statement = $conn->prepare($query);
        $check =  $statement->execute($data_array);
        if ($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result) > 0) {
                return $result;
            }
        }

        return false;
    }


    public function get_user($userid)
    {
        $conn = $this->connect();
        $arr['userid'] = $userid;
        $query = 'select * from users where userid = :userid limit 1';
        $statement = $conn->prepare($query);
        $check =  $statement->execute($arr);
        if ($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result) > 0) {
                return $result[0];
            }
        }

        return false;
    }

    public function generate_id($max)
    {
        $rand_count = rand(4, $max);
        $rand = "";
        for ($i = 0; $i < $rand_count; $i++) {
            $r = rand(0, 9);
            $rand .= $r;
        }
        return $rand;
    }
}
