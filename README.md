# Biblioteca

Aplicación para la gestión de una biblioteca.

## Descripción

Este proyecto es una aplicación web desarrollada en PHP con el patrón MVC. Permite a los usuarios gestionar los libros, préstamos y devoluciones de una biblioteca.

## Características

* Gestión de libros: altas, bajas y modificaciones.
* Gestión de socios: altas, bajas y modificaciones.
* Gestión de préstamos: registro y devolución.
* Búsqueda de libros y socios.

## Requisitos

* Servidor web (Apache, Nginx, etc.).
* PHP 7.4 o superior.
* MySQL o MariaDB.

## Instalación

1. **Clonar el repositorio:**

   ```bash
   git clone https://github.com/usuario/biblioteca.git
   ```

2. **Crear la base de datos:**

   - Crea una base de datos en tu servidor MySQL.
   - Importa el archivo `app/sql/biblioteca.sql` para crear las tablas y los datos iniciales.

3. **Configurar la conexión a la base de datos:**

   - Renombra el archivo `app/libs/Config.example.php` a `app/libs/Config.php`.
   - Modifica el archivo `app/libs/Config.php` con los datos de tu conexión a la base de datos:

     ```php
     <?php
     define('HOST', 'localhost');
     define('DB', 'nombre_de_la_base_de_datos');
     define('USER', 'tu_usuario');
     define('PASSWORD', 'tu_contraseña');
     define('CHARSET', 'utf8mb4');
     ?>
     ```

4. **Configurar el servidor web:**

   - Configura la raíz de tu servidor web para que apunte al directorio `public` del proyecto.
   - Asegúrate de que el módulo `rewrite` de Apache (o su equivalente en tu servidor) esté activado para que las URL amigables funcionen.

5. **Acceder a la aplicación:**

   - Abre tu navegador y accede a la URL de tu proyecto.

## Uso

1. **Iniciar sesión:**

   - Accede a la página de inicio de sesión e introduce tus credenciales.
   - El usuario por defecto es `admin` y la contraseña `admin`.

2. **Gestionar libros:**

   - En el menú principal, selecciona "Libros".
   - Desde aquí podrás ver, añadir, editar y eliminar libros.

3. **Gestionar socios:**

   - En el menú principal, selecciona "Socios".
   - Desde aquí podrás ver, añadir, editar y eliminar socios.

4. **Gestionar préstamos:**

   - En el menú principal, selecciona "Préstamos".
   - Desde aquí podrás registrar nuevos préstamos y marcar los libros como devueltos.

## Contribuir

Si quieres contribuir a este proyecto, por favor sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama para tu nueva funcionalidad (`git checkout -b nueva-funcionalidad`).
3. Haz tus cambios y haz commit (`git commit -am 'Añade nueva funcionalidad'`).
4. Haz push a tu rama (`git push origin nueva-funcionalidad`).
5. Crea un nuevo Pull Request.

## Licencia

Este proyecto está bajo la Licencia MIT.
