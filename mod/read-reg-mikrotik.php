<?php 
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

//Actualizado 14/04/2019

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password, $db_name);

if (isset($userweb)) {
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT * FROM mikrotik WHERE Usuarios = ? ");
    $stmt->bind_param("s", $userweb);
    $stmt->execute();
    $stmt->store_result();

    if (($stmt->num_rows) > 0) {
        $stmt->bind_result($data0, $data1, $data2, $data3, $data4,$data5,$data6,$data7);

        while ($stmt->fetch()) {
            echo '<div class="panel">    
                    <div class="panel-body">
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <table width="100%" class="table" id="dataTables-example">
                                    <tbody>
                                        <tr>
                                            <td>Dominio: </td><td>'.$data5.'</td>    
                                        </tr>
                                        <tr>
                                            <td>Ubicado en: </td><td>'.$data2.'</td>    
                                        </tr>
                                    </tbody>
                                </table> 
                            </div> 
                        </div> 
                    </div>      
                </div>';
        }
    } else {
        echo '<h4 class="small font-weight-bold"> Aún no tienes Routers Borde en Alta </h4>
            <hr>';
    }
} else {
    $_SESSION['mensaje'] = 'Error de procesamiento de datos libreria read-reg-mikrotik.php ';
}
