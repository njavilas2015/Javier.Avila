<?php 
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

//Actualizado 14/04/2019

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password, $db_name);

if (isset($userweb)) {
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT * FROM contabilidad WHERE Empresa = ? ORDER BY id DESC ");
    $stmt->bind_param("s", $userweb);
    $stmt->execute();
    $stmt->store_result();

    if (($stmt->num_rows) > 0) {
        $stmt->bind_result($data0, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11);

        while ($stmt->fetch()) {
            if ($data8 !== 'Anulada') {
                echo '<h4 class="small font-weight-bold"> Comprobante: ' . $data3 . $data4  .'  <span class="float-right"> ' . $data2 . ' </span></h4>
                    
                <h4 class="small font-weight-bold">';
                if ($data8 === 'Impaga') {
                    echo       
                        '<span class="float-right" style="color: red;"> ¡' . $data8 .'! Saldo pendiente: $'.$data9.'</span></h4>
                        ';}

                if ($data8 === 'Abonada') {
                    echo       
                        '<span class="float-right" style="color: green;"> ' . $data8 .' Monto $'. $data6.'</span></h4>
                        ';}

                $explotar = array();
                $explotar = explode(',',$data5);
                echo '<ul style="list-style:none">';
                for ($i = 0; $i <= (count($explotar)-1); $i++) {
                    echo '<li>'.$explotar[$i].'</li>';
                }
                echo '</ul>
                &nbsp <a href="/comprobantes/' . $data3 . $data4  .'.pdf" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Descargar ' . $data3 . $data4  .'</a> ';
                
                
                
            }
            echo '<hr>';
            
        }
    } else {
        echo '<h4 class="small font-weight-bold"> Aún no se ha registrado pagos <span class="float-right"><a target="_blank" rel="nofollow" href="https://undraw.co/">Dar aviso de un pago realizado &rarr;</a></span></h4>
            <hr>';
    }
} else {
    $_SESSION['mensaje'] = 'Error de procesamiento de datos libreria check-payment.php ';
}
 