<?php 


class Database
{
    private $servername = "localhost";
    private $username = "root";       
    private $password = "";       
    public $connect ='' ;
    public function __construct()
    {
        try {

            $this->connect = new PDO("mysql:host=$this->servername;dbname=rappelPhp",$this->username , $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $T) {
            echo "Connection failed :".$T->getMessage();
        }
    }   
}



?>