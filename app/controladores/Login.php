<?php
/**
 * 
 */
class Login extends controlador{
    //code
    private $modelo = "";
    function __construct()
    {
        //code
        $this->modelo = $this->modelo("LoginModelo");
    }
    public function caratula(){
        $datos = [
            "titulo" => "Sistema de Biblioteca - Login",
            "subtitulo" => "Sistema de Biblioteca"
        ];
        $this->vista("LoginCaratulaVista", $datos);
    }   
    public function olvido(){
        $datos = [
            "titulo" => "olvido de clave - Biblioteca",
            "subtitulo" => "¿Olvidaste tu clave de acceso?"
        ];
        $this->vista("loginOlvidoVista", $datos);
    }  
}
?>