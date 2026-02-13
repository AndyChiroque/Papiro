<?php  
/**
 * 
 */
class Login extends Controlador
{
	private $modelo = "";
	
	function __construct()
	{
		$this->sesion = new Sesion();
		if ($this->sesion->getLogin()) {
			$this->sesion->finalizarLogin();
		}
		$this->modelo = $this->modelo("LoginModelo");
	}

	public function caratula()
	{
		if (isset($_COOKIE['datos'])){
			$datos_array = explode("|",$_COOKIE['datos']);
			$usuario = $datos_array[0];
			$clave = Helper::desencriptar($datos_array[1]);
			$data = [
				"usuario" => $usuario,
				"clave" => $clave
			];
		}else{
			$data = [];
		}
		$datos = [
			"titulo" => "Entrada a la biblioteca",
			"subtitulo" => "Sistema de biblioteca",
			"data" => $data
		];
		$this->vista("loginCaratulaVista",$datos);
	}

	public function registrar(){
	   //Definir los arreglos
	    $data = array();
	    $errores = array(); 
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST" ){
	    	//Vista Auto registro
	    	$genero = $this->modelo->getCatalogo("genero");
		    $datos = [
		      "titulo" => "Auto registro de un usuario",
		      "subtitulo" => "Auto registro de un usuario",
		      "activo" => "login",
		      "menu" => false,
		      "admon" => "admon",
		      "genero" => $genero,
		      "estado" => USUARIO_INACTIVO,
		      "errores" => $errores,
		      "data" => []
		    ];
		    $this->vista("loginRegistrarUsuarioVista",$datos);
	    }
  	}
	
	
	public function olvidoVerificar()
	{
		$errores = [];
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$usuario = $_POST['usuario']??"";
			if (empty($usuario)) {
				array_push($errores, "El correo electrónico es requerido.");
			}
			if (filter_var($usuario,FILTER_VALIDATE_EMAIL)==false) {
				array_push($errores, "El correo electrónico no está bien escrito.");
			}
			if (empty($errores)) {
				//
				if ($this->modelo->buscarCorreo($usuario)) {
					//El ! significa que si se envió el correo
					//Se debe quitar el ! para pruebas sin enviar correo
					if (!$this->modelo->enviarCorreo($usuario)) {
						$datos = [
							"titulo" => "Cambio de clave de acceso",
							"menu" => false,
							"errores" => [],
							"data" => [],
							"subtitulo" => "Cambio de clave de acceso",
							"texto" => "Se ha enviado un correo a <b>".$usuario."</b> para que puedas cambiar tu clave de acceso. Cualquier duda te puedes comunicar con nosotros. No olvides revisar tu bandeja de spam.",
							"color" => "alert-success",
							"url" => "login",
							"colorBoton" => "btn-success",
							"textoBoton" => "Regresar"
						];
						$this->vista("mensaje",$datos);
					} else {
						$datos = [
							"titulo" => "Error al Cambio de clave de acceso",
							"menu" => false,
							"errores" => [],
							"data" => [],
							"subtitulo" => "Error al Cambio de clave de acceso",
							"texto" => "Error al Cambio de clave de acceso a <b>".$usuario."</b> para que puedas cambiar tu clave de acceso. 
							Cualquier duda te puedes comunicar con nosotros. Intentalo mas tarde.",
							"color" => "alert-danger",
							"url" => "login",
							"colorBoton" => "btn-danger",
							"textoBoton" => "Regresar"
						];
						$this->vista("mensaje",$datos);
					}
					exit;
				} else {
					array_push($errores, "No se encontró el correo electrónico.");
				}
			}
		}
		$datos = [
			"titulo" => "Olvido de contraseña",
			"subtitulo" => "¿Olvidaste la contraseña?",
			"errores" => $errores,
			"data" => []
		];
		$this->vista("loginOlvidoVista",$datos);
	}
	public function cambiarClave($id='')
	{
		$id=Helper::Desencriptar($id);
		$errores = [];
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$clave1 = $_POST['clave']??"";
			$clave2 = $_POST['Verifica']??"";
			$id = $_POST['id']??"";
			//
			if(empty($clave1)){
				array_push($errores,"La clave de acceso es requerida.");
			}
			if(empty($clave2)){
				array_push($errores,"La clave de acceso de verificacion es requerida.");
			}
			if(($clave1!=$clave2)){
				array_push($errores,"La clave de acceso no coinciden.");
			}
			if(count($errores)==0){
				$clave = hash_hmac("sha256",$clave1,CLAVE);
				$data = [ "clave"=> $clave,"id"=>$id];
				//Helper::mostrar($data);
				if($this->modelo->actualizarClaveAcceso($data)){
					$datos = [
							"titulo" => "Cambio de clave de acceso",
							"menu" => false,
							"errores" => [],
							"data" => [],
							"subtitulo" => "Cambio de clave de acceso",
							"texto" => "La clave de acceso se ha cambiado correctamente.",
							"color" => "alert-success",
							"url" => "login",
							"colorBoton" => "btn-success",
							"textoBoton" => "Regresar"
							];
						$this->vista("mensaje",$datos);
				}else{
					$datos = [
							"titulo" => "Cambio de clave de acceso",
							"menu" => false,
							"errores" => [],
							"data" => [],
							"subtitulo" => "Cambio de clave de acceso",
							"texto" => "Error al cambiar la clave de acceso.",
							"color" => "alert-danger",
							"url" => "login",
							"colorBoton" => "btn-danger",
							"textoBoton" => "Regresar"
							];
						$this->vista("mensaje",$datos);
				}
				exit;
			}
		}
		$datos = [
			"titulo" => "Cambio de clave de acceso",
			"subtitulo" => "Cambiar Contraseña",
			"errores" => $errores,
			"data" => $id

		];
		$this->vista("loginCambiarVista",$datos);
	}
	public function verificar()
	{
		$errores = [];
		if ($_SERVER["REQUEST_METHOD"]=="POST") {
			$id = $_POST["id"]??"";
			$usuario = $_POST["usuario"]??"";
			$clave = $_POST["clave"]??"";
			$recordar = isset($_POST['recordar'])? "on" : "off";
			$valor = $usuario."|".Helper::encriptar($clave);

			if ($recordar=="on") {
				$fecha = time()+(60*60*24*7);
			}else {
				$fecha = time()- 1;
			}
			setcookie("datos",$valor,$fecha,RUTA);

			//

			if (empty($clave)) {
				array_push($errores, "La clave de acceso es requerida.");
			}
			if (empty($usuario)) {
				array_push($errores, "El usuario es requerido.");
			}
			if (count($errores)==0) {
				$clave = hash_hmac("sha256",$clave,CLAVE);
				$data = $this->modelo->buscarCorreo($usuario);
				if(isset($data) && $data["clave"]==$clave){
					$sesion=new Sesion();
					$sesion->iniciarLogin($data);
					header("location:".RUTA."tablero");
					//Helper::mostrar($sesion->getLogin());
				} else {
					$datos = [
						"titulo" => "Entrada a la biblioteca",
						"menu" => false,	
						"errores"	=> [],
						"data" => [],
						"subtitulo" => "Sistema de biblioteca",
						"texto" => "Usuario o clave de acceso incorrectos.",
						"color" => "alert-danger",
						"url" => "login",
						"colorBoton" => "btn-danger",
						"textoBoton" => "Regresar"
					];
					$this->vista("mensaje",$datos);
				}
				exit;
			}

		}
		$datos = [
			"titulo" => "Entrada a la biblioteca",
			"subtitulo" => "Sistema de biblioteca",
			"errores"	=> $errores		
		];
		$this->vista("loginCararulaVista",$datos);
	}
}

?>