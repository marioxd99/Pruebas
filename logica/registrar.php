<link rel="stylesheet" href="../css/estilos.css">
<?php

include("con_db.php");

$nombre = $_POST["usuarioRegistro"];
$email = $_POST["correo"];
$pass = $_POST["passRegistro"];
$pass2 = $_POST["passRepeated"];

if (strlen($pass) < 7) {
?>
    <h1 class="bad">Contraseña demasiado corta</h1>
<?php
}

if ($pass != $pass2) {
?>
    <?php
    header("location: ../index.php");
    ?>
    <h1 class="bad">No coinciden las contraseñas</h1>
    <?php
} else {
    $contrasenaUser = md5($pass);
    $consulta = "INSERT INTO datosusuario VALUES ('','$nombre','$email','$contrasenaUser','Usuario')";
    $resultado = mysqli_query($conex, $consulta);
    if (!$resultado) {
    ?>
        <h3 class="bad">Ha ocurrido un error</h3>
    <?php
    } else {
    ?>
        <h1 class="ok">¡Usuario registrado Correctamente!</h1>
        <?php
        header("location: ../index.php");
        ?>
<?php
    }
}
?>