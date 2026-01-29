<?php
/**
 * 
 */
 class Tablero extends Controlador
 {
    private $usuario = "";
    private $modelo = "";
    private $sesion;
    
    function __construct()
    {
        //Creamos sesion
        $this->sesion = new Sesion();
        
        //Validamos si el usuario ha iniciado sesion
        if ($this->sesion->getLogin()) {       
            $this->modelo = $this->modelo("TableroModelo");
            $this->usuario = $this->sesion->getUsuario();
        } else {
            header("location:".RUTA);
        }
    }

    public function caratula($value='')
    {
        $datos = [
            "titulo" => "Sistema a la biblioteca",
            "subtitulo" => $this->usuario["nombre"]." ".$this->usuario["apellidoPaterno"]." ".$this->usuario["apellidoMaterno"],
            "usuario" => $this->usuario,
            "data" => [],
            "menu" => true
        ];
        $this->vista("tableroCaratulaVista",$datos);
    }
}
?>