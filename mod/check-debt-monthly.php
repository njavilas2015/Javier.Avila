<?php
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

//Actualizado 14/04/2019

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password, $db_name);

if (isset($userweb)) {
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT SUM(Monto) FROM tb_service WHERE Usuarios = ?");
    $stmt->bind_param("s", $userweb);
    $stmt->execute();
    $stmt->store_result();

    if (($stmt->num_rows) > 0) {
        $stmt->bind_result($data0);
        while ($stmt->fetch()) {
            echo '$ '.$data0;
        }
    }else {
        echo 'Sin deuda';
    } 
} else {
    $_SESSION['mensaje'] = 'Error de procesamiento de datos libreria check-debt.php ';
}
?>