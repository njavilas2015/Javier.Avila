<?php 
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

//Actualizado 07/04/2019

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password, $db_name);

if (isset($userweb)) {
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT * FROM tb_registro_de_alertas WHERE Usuarios = ? ORDER BY id DESC LIMIT 5");
    $stmt->bind_param("s", $userweb);
    $stmt->execute();
    $stmt->store_result();

    if (($stmt->num_rows) > 0) {
        $stmt->bind_result($data0, $data1, $data2, $data3, $data4, $data5, $data6, $data7);
        $contador = 0;

        while ($stmt->fetch()) {
            echo '
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas ' . $data3 . ' text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">' . $data4 . ' a las ' . $data5 . '</div>
                            ' . $data2 . '
                    </div>
                </a>';
        }
        echo '<a class="dropdown-item text-center small text-gray-500" href="#">Ver historial de alertas</a>';
    } else {
        echo '
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-check text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">En este momento</div>
                            Aún no se ha registrado alertas
                    </div>
                </a>';
    }
} else {
    $_SESSION['mensaje'] = 'Error de procesamiento de datos libreria mod-check-alertas.php ';
}
?> 