<?php
/**
 * 
 */
class MySQLdb {
    private $host="localhost";
    private $usuario = "root";
    private $clave = "";
    private $db = "biblioteca";
    public $puerto = "";
    public $conn;


    function __construct()
    {
        try {
            $this->conn = new PDO(
                'mysql:host='.$this->host.';dbname='.$this->db, 
                $this->usuario, 
                $this->clave
            );
            //echo "Conexión exitosa a la base de datos.";
        } catch (Exception $e) {
            die("Error de conexión: " . $e->getMessage());
        }
}
}
?>