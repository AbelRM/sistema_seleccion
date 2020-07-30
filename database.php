<?php

class Database{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    private $root;

    public function __construct(){
        $this->host = 'localhost';
        $this->db = 'sistema_seleccion';
        $this->user = 'root';
        $this->password = '123456';
        $this->charset = 'utf8mb4';
        $this->root = '3307';
    }

    function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset .  ";root=" . $this->root;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }

}

?>