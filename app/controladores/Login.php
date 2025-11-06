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
    public function olvidoVerificar(){

        $errores = [];
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $usuario = $_POST['usuario']??"";
            if (empty($usuario)){
                array_push($errores, "El campo usuario es obligatorio");
            }
            if (filter_var($usuario, FILTER_VALIDATE_EMAIL) === false){
                array_push($errores, "El campo usuario debe ser un correo electrónico válido");
            }
            if (empty($errores)){
            Helper::mostrar($usuario);
            }
            Helper::mostrarErrores($errores);
        }
        $datos = [
			"titulo" => "Olvido de contraseña",
			"subtitulo" => "¿Olvidaste la contraseña?",
			"errores" => $errores,
			"data" => []
        ];
        $this->vista("loginOlvidoVista", $datos);
    }  
}
?>