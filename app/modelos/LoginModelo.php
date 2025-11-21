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

    public function enviarCorreo($email=''){
        $data = [];
        if ($email==""){
            return false;
        } else {
            $data = ["id"=>1]; 
            if (!empty($data)){
                $id = $data['id'];
                //
                $msg = "Hola, para restablecer tu contraseña, haz clic en el siguiente enlace: \n\n";
                $msg .= "<a href='".RUTA."login/cambiarclave/$id'>Restablecer Contraseña</a>\n\n";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Papiro\r\n";
                $asunto = "Cambiar clave de acceso";
                var_dump($msg);
                //return true;
                return @mail($email, $asunto, $msg, $headers);
            } else {
                
            }
        }
    }
}
?>