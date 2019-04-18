<?php 
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password,$db_name);

if (isset($userweb)) {
    $stmt = $conn->prepare("SELECT * FROM mensajeria WHERE Usuarios = ?");
	$stmt->bind_param("s", $userweb);
	$stmt->execute();
	$stmt->store_result();

	if(($stmt->num_rows) > 0){
		$stmt->bind_result($data0,$data1,$data2,$data3,$data4);
        $contador = 0;
            
        while ($stmt->fetch()) 	{
            if ($data3 === "0"){
                $contador ++;
                
            }
        }
        echo $contador;
    }else{
        echo '0';
    }
    
}else {
    $_SESSION['mensaje']='Error de procesamiento de datos libreria mod-check-message.php ';
}
?>