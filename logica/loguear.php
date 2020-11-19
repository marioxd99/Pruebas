<?php

include('con_db.php');
session_start();
sleep(1);
$usuario = $_POST['user'];
$clave = $_POST['contrasena'];
$clavemd5 = md5($clave);

$q = "SELECT id,nombre,rol FROM datosusuario WHERE nombre='$usuario' and contraseña='$clavemd5'";
$consulta = mysqli_query($conex, $q);

if (mysqli_num_rows($consulta) > 0) {
    $datos = mysqli_fetch_assoc($consulta);
    $_SESSION['usuario']=$datos;
    echo json_encode(array('error' => false,'rol' => $datos['rol']));
} else {
   echo json_encode(array('error'=> true));
}

?>