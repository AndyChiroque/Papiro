<?php  
/**
 * 
 */
class Login extends Controlador
{
	private $modelo = "";
	
	function __construct()
	{
		$this->modelo = $this->modelo("LoginModelo");
	}

	public function caratula()
	{
		$datos = [
			"titulo" => "Entrada a la biblioteca",
			"subtitulo" => "Sistema de biblioteca"
		];
		$this->vista("loginCaratulaVista",$datos);
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
					if (!$this->modelo->enviarCorreo($usuario)) {
						$datos = [
							"titulo" => "Cambio de clave de acceso",
							"menu" => false,
							"errores" => [],
							"data" => [],
							"subtitulo" => "Cambio de clave de acceso",
							"texto" => "Se ha enviado un correo a <b>".$usuario."</b> para que puedas cambiar tu clave de acceso. Cualquier duda te puedes comunicar con nosotros. No olvides revisar tu bandeja de spam.",
							"color" => "alert-warning",
							"url" => "login",
							"colorBoton" => "btn-warning",
							"textoBoton" => "Regresar"
						];
						$this->vista("mensaje",$datos);
						exit;
					} else {
						Helper::mostrar("No se envió el correo");
					}
				} else {
					Helper::mostrar("No se encontró el correo");
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
}

?>