<?php
session_start();
$now = time();
require_once("conexion.php");

$ip_visitante = $_SERVER['REMOTE_ADDR'];
$navegador_visitante = $_SERVER['HTTP_USER_AGENT'];
$id_sesion = $_SESSION["SKey"];




function update_close_session($estado){
	global $servername, $username, $password, $db_name;
	$conn = new mysqli($servername, $username, $password,$db_name);
	$nulo = null;
	if ($stmt = $conn->prepare("UPDATE master SET  IP_address = ?, Navegadores = ?, SKey_id = ?, Estados = ? WHERE Usuarios = ?")){
		$stmt->bind_param("sssss",$nulo,$nulo,$nulo,$estado ,$_SESSION["usuario"]);
		$stmt->execute();
    $stmt->close();
    $conn->close();
	echo 'Session user update';
	session_destroy();
    header ("Location: login.php");

  }else {
      echo 'Session user not update';
      $stmt->close();
      $conn->close();
	  session_destroy();
      header ("Location: login.php");
	}

}//fin de funcion de cierre de sesion

function verificaion(){
  global $ip_visitante, $navegador_visitante,$now;
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
            if($now > $_SESSION['expire']) {
                            $estado = 'Off-line';
                            update_close_session($estado);
                            //echo "Tu sesion ha expirado";

            }else{
                    global $servername, $username, $password, $db_name, $ip_visitante, $id_sesion, $navegador_visitante,$now;
                    $conn = new mysqli($servername, $username, $password,$db_name);
                    $stmt = $conn->prepare("SELECT * FROM master WHERE Usuarios = ?");
                    $stmt->bind_param("s", $_SESSION["usuario"]);
                    $stmt->execute();
                    $stmt->store_result();
                    if(($stmt->num_rows) > 0){
                        $stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7);
                        while ($stmt->fetch()) 	{
                            if (password_verify($ip_visitante, $data2) && password_verify($navegador_visitante, $data3) && password_verify($id_sesion, $data4) ) { 
                                echo 'TODO OK';
                            }else{echo 'Difieren';}
                        }
                    }else{
                        session_destroy();
                        header ("Location: login.php");
                        
                    }
            }
                                    
    }else {
        session_destroy();
        header ("Location: login.php");
        
    } 

}

verificaion();
?>