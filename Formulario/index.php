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
        session_start();
        error_reporting(0);


        $bienvenido = $_SESSION['bienvenido'];
        $inicio = $_SESSION['inicio'];


        //si vengo de la pagina Bienvenido.php
        if (isset($bienvenido)) {
            ?>
            <div class="errorlogin">
                <label>Usuario o contraseña incorrectos</label><br><br>
            </div>
            <?php
            unset($_SESSION["bienvenido"]);
        }
        //si es la primera vez en entro en index.php
        else if (!isset($inicio)) {

            $_SESSION['inicio'] = true;
            $conexion = new Conexion("localhost", "dani", "dani", "personas");
        }
        ?>

        <div class="divimgprincipal"><img src="Imagenes/principal.png" class="imgprincipal"></div>

        <div class="divlogin">
            <form action="Bienvenido.php" method="POST" class="form-horizontal">

                <div class="form-group">
                    Usuario<br> <input type="text" name="usuario" required class="inputslogin form-control"><br>
                    Contraseña<br> <input type="password" name="password" required class="inputslogin form-control">
                </div>
                <a href="EnviarCorreo.php">He olvidado contraseña</a><br><br><br>

                <input type="submit" name="aceptar" value="Aceptar" class="btn btn-primary inputbuttons">
                <input type="reset" name="reset" value="Reiniciar" class="btn btn-primary inputbuttons"><br><br>
            </form>

            <form action="Registro.php" method="POST">
                <div>
                    <input type="submit" name="registro" value="Registro" class="btn btn-primary form-control">
                </div>
            </form>
        </div>
    </body>
</html>
