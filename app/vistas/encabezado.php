<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print $datos['titulo']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</head>
<body>
    <nav class= "navbar navbar-expand-sm bg-dark navbar-dark">
        <a href='<?php print RUTA."tablero"; ?>' class="navbar-brand">Biblioteca</a>
        <?php 
        if (isset($datos["menu"]) && $datos["menu"]== true){
            print "<ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";
            // Autores
            print "<li class='nav-item'>";
            print "<a href='".RUTA."autores' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "autores") print "active";
            print "'>Autores</a>";
            print "</li>";
            // Libros
            print "<li class='nav-item'>";
            print "<a href='".RUTA."libros' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "libros") print "active";
            print "'>Libros</a>";
            print "</li>";
            // Usuarios
            print "<li class='nav-item'>";
            print "<a href='".RUTA."usuarios' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "usuarios") print "active";
            print "'>Usuarios</a>";
            print "</li>";
            // Categorias
            print "<li class='nav-item'>";
            print "<a href='".RUTA."categorias' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "categorias") print "active";
            print "'>Categorias</a>";
            print "</li>";
            // Editoriales
            print "<li class='nav-item'>";
            print "<a href='".RUTA."editoriales' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "editoriales") print "active";
            print "'>Editoriales</a>";
            print "</li>";
            // Temas
            print "<li class='nav-item'>";
            print "<a href='".RUTA."temas' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "temas") print "active";
            print "'>Temas</a>";
            print "</li>";
            // Idiomas
            print "<li class='nav-item'>";
            print "<a href='".RUTA."idiomas' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "idiomas") print "active";
            print "'>Idiomas</a>";
            print "</li>";
            // Prestamos
            print "<li class='nav-item'>";
            print "<a href='".RUTA."prestamos' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "prestamos") print "active";
            print "'>Prestamos</a>";
            print "</li>";
            // Copias
            print "<li class='nav-item'>";
            print "<a href='".RUTA."copias' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "copias") print "active";
            print "'>Copias</a>";
            print "</li>";
            // Paises
            print "<li class='nav-item'>";
            print "<a href='".RUTA."paises' class='nav-link ";
            if(isset($datos["activo"]) && $datos["activo"] == "paises") print "active";
            print "'>Paises</a>";
            print "</li>";
            // Respaldar
            print "<li class='nav-item'>";
            print "<a href='".RUTA."tablero/respaldar' class='nav-link'>Respaldar</a>";
            print "</li>";
            print "</ul>";
        }
        ?>
    </nav>
    
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php
                if (isset($datos['errores'])){
                    if (count($datos["errores"])>0){
                        print "<div class='alert alert-danger mt-3'><ul>";
                        foreach ($datos["errores"] as $valor){
                            print "<li>" .$valor. "</li>";
                        }
                        print "</ul></div>";
                    }
                }
                ?>
                <div class ="card p-4 mt-3 bg-ligth">
                    <div class ="card-header text-center">
                        <h2><?php print $datos['subtitulo']; ?></h2>
                    </div>
                    <div class ="card-body">
