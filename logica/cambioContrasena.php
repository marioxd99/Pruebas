
<?php
//-----------------Cambio de Contraseña--------------
session_start();
require "con_db.php";

$usuario = $_SESSION['usuario']['nombre'];
$passActual = $_POST['passActual'];
$pass1 = $_POST['passNueva'];
$pass2 = $_POST['passNuevaC'];
if (strlen($passActual) > 4 and strlen($pass1) > 4 and strlen($pass2) > 4) {

    $passActual = md5($passActual);
    $pass1 = md5($pass1);
    $pass2 = md5($pass2);

    $q1 = "SELECT id FROM datosusuario WHERE nombre='$usuario' and contraseña='$passActual'";
    $sqlB = mysqli_query($conex, $q1);
    $rowB = mysqli_fetch_array($sqlB);
    $id = $rowB["id"];

    $_SESSION['id'] = $id;
    $q = "SELECT contraseña FROM datosusuario WHERE id='{$_SESSION['id']}'";
    $sqlA = mysqli_query($conex, $q);
    $rowA = mysqli_fetch_array($sqlA);

    if ($rowA['contraseña'] == $passActual) {
        if ($pass1 == $pass2) {
            $sqlupdate = mysqli_query($conex, "UPDATE datosusuario SET contraseña='$pass1' WHERE id='{$_SESSION['id']}'");
            if ($sqlupdate) {
                echo json_encode('correcto');
            } else {
                echo json_encode('error');
            }
        }
    } else {
        echo json_encode('error');
    }
} else {
    echo json_encode('error');
}
?>
