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
		// Recibimos la información de la vista
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			//
			$idTipoUsuario = Helper::cadena($_POST['idTipoUsuario'] ?? "");
			$correo = Helper::cadena($_POST['correo'] ?? "");
			$verificarCorreo = Helper::cadena($_POST['verificarCorreo'] ?? "");
			$nombre = Helper::cadena($_POST['nombre'] ?? "");
			$apellidoPaterno = Helper::cadena($_POST['apellidoPaterno'] ?? "");
			$apellidoMaterno = Helper::cadena($_POST['apellidoMaterno'] ?? "");
			$genero = Helper::cadena($_POST['genero'] ?? "");
			$telefono = Helper::cadena($_POST['telefono'] ?? "");
			$fechaNacimiento = Helper::cadena($_POST['fechaNacimiento'] ?? "");
			$estado = USUARIO_INACTIVO;
			//
			//validamos la info
			//

			// 1. Validar formato (usando tu clase Helper)
			if (Helper::correo($correo) == false) {
				array_push($errores, "El correo no tiene un formato correcto.");
			}

			// 2. Validar que no esté vacío
			if (empty($correo)) {
				array_push($errores, "El correo es requerido.");
			}

			// 3. Validar unicidad (Consulta al Modelo)
			if ($this->modelo->buscarCorreo($correo)) {
				array_push($errores, "El correo ya existe en la base de datos.");
			}
			
			// 1. Validar formato del segundo campo
			if (Helper::correo($verificarCorreo) == false) {
				array_push($errores, "El correo de verificación no tiene un formato correcto.");
			}

			// 2. Validar que ambos campos sean iguales
			if ($correo != $verificarCorreo) {
				array_push($errores, "Los correos no coinciden.");
			}
			/*--------------------------------------------------*/
			if (empty($nombre)) {
				array_push($errores, "El nombre es requerido.");
			}
			// 1. Validar Apellido Paterno
			if (empty($apellidoPaterno)) {
				array_push($errores, "El apellido paterno es requerido.");
			}

			// 2. Validar Formato de Fecha (usando tu Helper)
			if (Helper::fecha($fechaNacimiento) == false) {
				array_push($errores, "El formato de la fecha de nacimiento no es correcto.");
			}

			/*--------------------------------------------------*/
			// 3. Control de Errores Final
			if (empty($errores)) { 
			// Crear arreglo de datos
			//
			$clave = "12345"; //Helper::generarClave(10);
			$data = [
		         "idTipoUsuario"=>$idTipoUsuario,
		         "correo"=> $correo,
		         "nombre"=> $nombre,
		         "clave"=>$clave,
		         "apellidoPaterno"=> $apellidoPaterno,
		         "apellidoMaterno"=> $apellidoMaterno,
		         "genero"=> $genero,
		         "telefono"=> $telefono,
		         "fechaNacimiento"=> $fechaNacimiento,
		         "estado"=> USUARIO_INACTIVO
		    ];     
		    Helper::mostrar($data);
	      }
		}
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
		$this->vista("loginCaratulaVista",$datos);
	}
}

?>