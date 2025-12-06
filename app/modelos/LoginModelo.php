<?php  
/**
 * 
 */
class LoginModelo
{
	private $db="";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function buscarCorreo($usuario='')
	{
		if(empty($usuario)) return false;
		$sql = "SELECT * FROM usuarios WHERE correo='".$usuario."'";
		return $this->db->query($sql);
	}

	public function enviarCorreo($email='')
	{
		$data = [];
		if ($email=="") {
			return false;
		} else {
			$data = ["id"=>1]; //$this->validarCorreo($email);
			if (!empty($data)) {
				$id = $data["id"];
				//
				$msg = "Entra a la siguiente liga para cambiar tu clave de acceso al sistema de biblioteca...<br>";
				$msg.= "<a href='".RUTA."login/cambiarclave/".$id."'>Cambiar tu clave de acceso</a>";

				$headers = "MIME-Version: 1.0\r\n"; 
				$headers.= "Content-type:text/html; charset=UTF-8\r\n"; 
				$headers.= "From: Biblioteca\r\n"; 
				$headers.= "Reply-to: ayuda@biblioteca.com\r\n";

				$asunto = "Cambiar clave de acceso";
				//var_dump($msg);
				//return true;
				return @mail($email,$asunto,$msg, $headers);
			} else {
			}
		}
	}
}

?>