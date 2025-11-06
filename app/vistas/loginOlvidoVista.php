<?php include("encabezado.php"); ?>
                        <form action="<?php echo RUTA; ?>login/olvidoVerificar" method="post">
                            <h2 class="text-center">Login</h2>
                            <div class="form-group text-left">
                                    <label for="usuario">* Correo</label>
                                    <input type="email" name="usuario" class="form-control" placeholder="Escribe tu Correo" required />
                            </div>   
                            <div class="form-group text-left">
                                    <input type="submit" value="Enviar" class="btn btn-primary"/>
                                    <a href="<?php echo RUTA; ?>login/caratula" type="button" class="btn btn-info">Cancelar</a>
                            </div>
                        </form>
<?php include("piePagina.php"); ?>
