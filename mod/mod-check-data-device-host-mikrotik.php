<?php 
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password,$db_name);

if (isset($userweb)) {
    $stmt = $conn->prepare("SELECT * FROM tb_usuarios_lease_mikrotik WHERE Usuarios = ?");
	$stmt->bind_param("s", $userweb);
	$stmt->execute();
	$stmt->store_result();

	if(($stmt->num_rows) > 0){
		$stmt->bind_result($data0,$data1,$data2,$data3,$data4);
        $contador = 0;
        echo '
        
            <tbody>';
            
        while ($stmt->fetch()) 	{
            echo '
            <tr>
                <td>'.$data1.'</td>
                <td>'.$data2.'</td>
                <td>'.$data3.'</td>
                <td>'.$data4.'</td>
            </tr>';            
        }
        echo ' </tbody>
        ';
        
    }else{
        echo 'No existe datos';
    }
    
}else {
    $_SESSION['mensaje']='Error de procesamiento de datos libreria mod-check-message.php ';
}
?>