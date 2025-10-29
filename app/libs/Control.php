<?php
/**
 * 
 */
class Control {

    private $controlador = "Login"; 
    private $metodo = "caratula";
    private $parametros = [1,2,3];

    function __construct()
    {
        $url = $this->separarURL();
        //Helper::mostrar($url);

        //buscar el controlador
        if ($url !="" && file_exists("../app/controladores/".ucwords($url[0]).".php")) {
            $this-> controlador = ucwords($url[0]);
            unset($url[0]);
        }
        //
        //cargar la clase
        //
        require_once ("../app/controladores/".ucwords($this->controlador).".php");
        //
        //crear la instancia
        //
        $this->controlador = new $this->controlador;            
        //Helper::mostrar($url);
        //
        //buscar el metodo
        //
        if (isset($url[1])) {
            if (method_exists($this->controlador, $url[1])) {
                $this->metodo = $url[1];
                unset($url[1]);
            }
        }
        //buscar los parametros
        $this->parametros = $url ? array_values($url) : [];
        //ejecutar el metodo con parametros     
        call_user_func_array(
            [$this->controlador, $this->metodo],
            $this->parametros
        );


    }
    public function separarURL(){
        $url = "";
        if (isset($_GET['url'])) {
            //eliminamos la barra del final
            $url = rtrim($_GET['url'], '/');
            $url = rtrim($_GET['url'], '\\');
            //sanitizamos la url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //separamos la url
            $url = explode('/', $url);
            
        }
        //print_r($url);
        return $url;
    }
}
?>