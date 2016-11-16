<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

        <link rel="stylesheet" href="estilos.css">

        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
    </head>
    <body>
        <?php
        require 'Modelo/Conexion.php';
        require 'Modelo/Usuario.php';
        session_start();
        //error_reporting(0);

        $usuario = $_REQUEST["usuario"];
        $password = $_REQUEST["password"];
        $index = $_REQUEST["aceptar"];
        $registro = $_REQUEST["registrar"];
        
        echo 'prueba';
        
        $passhash = base64_encode($password);


        //si vengo de index.php
        if (isset($index)) {

            $conexion = new Conexion("personas", "dani", "dani");
            //relleno el cursor con los datos del login
            $conexion->rellenar_cursor_login("usuario", $usuario, $password);

            //compruebo si el cursor devuelve algun dato
            if ($conexion->siguiente()) {

                //creo un usuario de tipo Usuario
                $u = new Usuario($conexion->obtener_campo("nombre"), $conexion->obtener_campo("apellidos"), $conexion->obtener_campo("fecha_nac"), $conexion->obtener_campo("email"), $conexion->obtener_campo("tlf"), $conexion->obtener_campo("password"));

                //guardo el usuario en la sesion
                $_SESSION['u'] = $u;
                ?>

                Bienvenido <?php echo $usuario ?>
                <?php
            }
            //si el cursor no devuelve ningun dato es que no esta registrado
            else {

                /* guardo en la sesion una variable bienvenido para saber en la pagina
                  index.php que vengo de Bienvenido.php para mostrar que usuario o contrase incorrectos
                 */
                $_SESSION['bienvenido'] = true;
                header("Location: index.php");
            }
        }
        //si vengo de Registro.php
        else if (isset($registro)) {

            $email = $_REQUEST["email"];

            $conexion = new Conexion("personas", "dani", "dani");
            //relleno el cursor con los datos del registro(unicamente el email)
            $conexion->rellenar_cursor_registro("usuario", $email);

            //si el cursor devuelve datos es que el email ya existe
            if ($conexion->siguiente()) {

                /* guardo en sesion una variable bienvenidoregistro para saber en la pagina
                  Registro.php que vengo de Bienvenido.php para mostrar que el email no esta disponible
                 */
                $_SESSION['bienvenidoregistro'] = true;
                header("Location: Registro.php");
            }
            //si no devuelve datos el cursor
            else {
                
                //si la inserccion del nuevo usuario devuelve 1 es que esta insertado correctamente
                if ($conexion->insertar_usuario("usuario", $_REQUEST["nombre"], $_REQUEST["apellidos"], $_REQUEST["fechanacimiento"], $_REQUEST["email"], $_REQUEST["tlf"], $passhash)) {
                    ?>c
                    <script>alert("Registrado con exito");</script>
                    Bienvenido <?php echo $_REQUEST["email"] . $passhash; ?>
                    <?php
                }
                //si devuelve 0 es que ha habido un error en la inserccion
                else {
                    ?>
                    <script>alert("Error en el registro");</script>
                    <?php
                }
            }
        }
        ?>
    </body>
</html>