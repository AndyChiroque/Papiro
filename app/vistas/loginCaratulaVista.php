<?php include("encabezado.php"); ?>
                        <form action="<?php echo RUTA; ?>login/verificar" method="post">
                            <h2 class="text-center">Login</h2>
                            <div class="form-group text-left">
                                    <label for="usuario">* Usuario</label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" 
                                    value="<?php print isset($datos['data']['usuario'])?$datos['data']['usuario']:''; ?>"/>
                            </div>   
                            <div class="form-group text-left">
                                    <label for="clave">* Clave de acceso</label>
                                    <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave de acceso" 
                                    value="<?php print isset($datos['data']['clave'])?$datos['data']['clave']:''; ?>"/>
                            </div>
                            <div class="form-group text-left mt-2">
                                <input type="checkbox" name="recordar" id="recordar" 
                                <?php print isset($datos['data']['usuario'])?'checked':'';?>/>
                                <label for="recordar">Recordar mis datos de acceso</label>
                            </div>
                            <div class="form-group text-left">
                                    <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                            <a href="<?php echo RUTA; ?>login/olvidoVerificar">¿Olvidaste tu clave de acceso?</a><br>
                            <a href="#">¿No tienes cuenta? Regístrate</a>
                        </form>
<?php include("piePagina.php"); ?>
