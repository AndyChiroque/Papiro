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

    //para consultas de selección
    public function query($sql=""){
        if(empty($sql)) return false;
        $stmt = $this->conn->query($sql);
        return $stmt->fetch();
    }

    //para consultas de selección
    public function querySelect($sql='')
	{
		if (empty($sql)) return false;
		$data = [];
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		   do {
		       array_push($data,$row);
		   } while ($row = $stmt->fetch(PDO::FETCH_ASSOC));
		if (!$data[0]) {
			$data = [];
		}
		return $data;
	}

    //Para consultas de inserción, actualización y eliminación
    public function queryNoSelect($sql,$data){
        return $this->conn->prepare($sql)->execute($data);
    }
}
?>