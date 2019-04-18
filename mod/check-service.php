<?php 
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

//Actualizado 14/04/2019

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password, $db_name);

if (isset($userweb)) {
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT * FROM tb_service WHERE Usuarios = ? ");
    $stmt->bind_param("s", $userweb);
    $stmt->execute();
    $stmt->store_result();

    if (($stmt->num_rows) > 0) {
        $stmt->bind_result($data0, $data1, $data2, $data3, $data4,$data5,$data6);

        while ($stmt->fetch()) {
            echo '<h4 class="small font-weight-bold">' . $data2 . '<span class="float-right"><small>'. $data6 . '</small> $ ' . $data5 . '</span></h4>
            <hr>';
        }
    } else {
        echo '<h4 class="small font-weight-bold"> Aún no tienes servicios contratados <span class="float-right"><a target="_blank" rel="nofollow" href="https://undraw.co/">Link para contratar servicios &rarr;</a> </span></h4>
            <hr>';
    }
} else {
    $_SESSION['mensaje'] = 'Error de procesamiento de datos libreria check-service.php ';
}
?> 