<?php
/**
 * 
 */
class Helper {

    public static function mostrar($data = '', $detener=true)
    {
       print "<pre>";
       var_dump($data); 
       print "</pre>";  
       if ($detener){
           exit;
       }
    }
    public static function Encriptar($data)
    {
        return base64_encode(LLAVE1.$data.LLAVE2);
    }
    public static function Desencriptar($data)
    {
        $cadena = base64_decode($data);
        $cadena = str_replace(LLAVE1,"",$cadena);
        return str_replace(LLAVE2,"",$cadena);
    }
    public static function Cadena($cadena)
    {
    // Definimos las palabras prohibidas y sus reemplazos
    $buscar = array('^', 'delete', 'drop', 'truncate', 'exec', 'system');
    $reemplazar = array('-', 'dele*te', 'dr*op', 'truneca*te', 'ex*ec', 'syst*em');

    // 1. Reemplazamos las palabras y eliminamos espacios en blanco extra
    $cadena = trim(str_replace($buscar, $reemplazar, $cadena));

    // 2. Convertimos caracteres especiales a entidades HTML (previene XSS)
    // 3. Agregamos barras invertidas antes de comillas (ayuda contra inyecciones básicas)
    $cadena = addslashes(htmlentities($cadena));

    return $cadena;
    }

    public static function fecha($cadena = "") {
    // Estándar ISO AAAA-MM-DD
    $salida = false;

    if ($cadena != "") {
        // Divide la cadena en un array usando el guion como separador
        $fecha_array = explode("-", $cadena);

        /**
         * checkdate(mes, día, año)
         * Nota: el orden de los índices es crucial:
         * [0] es Año, [1] es Mes, [2] es Día
         */
        if (count($fecha_array) == 3) {
            $salida = checkdate($fecha_array[1], $fecha_array[2], $fecha_array[0]);
        }
    }

    return $salida;
    }
    public static function correo($correo = '')
    {
        /**
         * filter_var devuelve el correo si es válido, o false si no lo es.
         * Al usarse en un 'if', el string del correo se evalúa como true.
         */
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }
}
?>