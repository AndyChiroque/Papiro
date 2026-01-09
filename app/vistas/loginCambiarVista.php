<?php include("encabezado.php"); ?>
    <form action="<?php echo RUTA; ?>login/cambiarClave/" method="post">
        <div class= "form-group text-left">
            <label for="clave">Nueva Constraseña:</label>
            <input type="password" name="clave" class="form-control" placeholder="Escribe tu nueva Contraseña" required>
        </div>
        <div class= "form-group text-left">
            <label for="Verifica">Repite tu Constraseña:</label>
            <input type="password" name="Verifica" class="form-control" placeholder="Repite tu nueva Contraseña" required>
        </div>
        <div class="form-group text-left mt-2">
            <input type="submit" value="Enviar" class="btn btn-success">
            <input type="hidden" name="id" id="id" value="<?php print $datos['data']; ?>">
        </div>
    </form>
<?php include("piePagina.php"); ?>