<?php include("encabezado.php"); ?>
<form action="<?php print RUTA; ?>login/registrar/" method="POST">

    <div class="form-group text-left">
        <label for="correo">* Correo:</label>
        <input type="email" name="correo" id="correo" class="form-control" required>
    </div>

    <div class="form-group text-left">
        <label for="verificarCorreo">* Verificar correo:</label>
        <input type="email" name="verificarCorreo" id="verificarCorreo" class="form-control" required>
    </div>
    <div class="form-group text-left">
        <label for="nombre">* Nombre(s):</label>
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escriba el nombre del usuario." required>
    </div>
    <div class="form-group text-left">
    <label for="apellidoPaterno">* Apellido paterno:</label>
    <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" placeholder="Escribe el apellido paterno del usuario." required>
    </div>

    <div class="form-group text-left">
        <label for="apellidoMaterno">Apellido materno:</label>
        <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="Escribe el apellido materno del usuario.">
    </div>

    <div class="form-group text-left">
        <label for="genero">* Género:</label>
        <select class="form-control" name="genero" id="genero" required>
            <option value="">---Selecciona un género---</option>
            <?php
            for ($i=0; $i < count($datos["genero"]); $i++) { 
                print "<option value='".$datos["genero"][$i]["id"]."'>";
                print $datos["genero"][$i]["genero"]."</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group text-left">
    <label for="telefono">Teléfono:</label>
    <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Escribe el teléfono del usuario.">
    </div>

    <div class="form-group text-left">
        <label for="fechaNacimiento">Fecha nacimiento:</label>
        <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control" placeholder="Seleccione la fecha de nacimiento del usuario.">
    </div>
    <div class="form-group text-left">
        <input type="hidden" name="idTipoUsuario" id="idTipoUsuario" value="3">
        
        <input type="submit" value="Enviar" class="btn btn-success">
        <a href="<?php print RUTA; ?>login" class="btn btn-info">Regresar</a>
    </div>

</form>

<?php include("piePagina.php"); ?>