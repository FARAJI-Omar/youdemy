<?php 
class connection{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "youdemy";

    protected $conn;

    public function __construct(){
        $this->connect();
    }

    private function connect(){
        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}







?>