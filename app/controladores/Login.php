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
        $datos = [];
        $this->vista("LoginCaratulaVista", $datos);
    }   
}
?>