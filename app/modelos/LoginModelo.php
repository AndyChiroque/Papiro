<?php
/**
 * 
 */
class LoginModelo{

    private $db = "";
    //code
    function __construct(){
        //code
        $this->db = new MySQLdb();
    }

    public function buscarCorreo($usuario=''){
        if(empty($usuario)){
            return false;
        }
        $sql = "SELECT * FROM usuarios WHERE correo= '" .$usuario. "'";
        return $this->db->query($sql);
    }
}
?>