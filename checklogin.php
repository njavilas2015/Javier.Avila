<?php
session_start();
require_once("/mod/conexion.php");
$userweb = $_POST['usuario'];
$passweb = $_POST['clave'];

//Codigo para obtener hora y fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')." A las: ". date('h:i:s A');

//proteccion contra ataques de fuerza bruta
function force_input(){
	if ($_SESSION['intentos'] >= 0 ){
			//intentos positivos
			if ( 2 > $_SESSION['intentos'] ){
				verifi_user();
			}else {
				$_SESSION['mensaje']='¡Atención! Tu cuenta ha sido bloqueada en este ordenador por superar el máximo permitido de 3 intentos, llámenos al 2615450939 para reactivar tu cuenta.';
				header ("Location: login.php");
			}
	}else {
				$_SESSION['mensaje']='Sesión negativa invalida ';
	     	//echo $_SESSION['mensaje'];
				header ("Location: login.php");
		}
}//fin de function

function update_session($hip, $hnavegador, $hSkey, $estado){
	global $servername, $username, $password, $db_name, $userweb ,$passweb,$fechas;

	$conn = new mysqli($servername, $username, $password,$db_name);
	if ($stmt = $conn->prepare("UPDATE master SET  IP_address = ?, Navegadores = ?, SKey_id = ?, Estados = ? WHERE Usuarios = ?")){
				$stmt->bind_param("sssss", $hip, $hnavegador, $hSkey, $estado, $userweb);
				$stmt->execute();
				$stmt->close();
				$conn->close();
				//echo 'Session user update';
				update_life_session();
				
	}else {
				//echo 'Session user not update';
				$_SESSION['mensaje']='¡Error inesperado al actualizar datos del usuario!';
				$conn->close();
				header ("Location: login.php");
	}
		
}//fin de update_session

function update_life_session(){
	global $servername, $username, $password, $db_name, $userweb ,$passweb,$fecha;
	$conn = new mysqli($servername, $username, $password,$db_name);
	
			if ($stmt = $conn->prepare("UPDATE master SET  Ultima_conexion = ? WHERE Usuarios = ?")){
				$stmt->bind_param("ss", $fecha ,$userweb);
				$stmt->execute();
				$stmt->close();
				$conn->close();
				//echo 'Session user update';
				header ("Location: pan.php");

			}else {
				echo 'Session user not update';
				$_SESSION['mensaje']='¡Error inesperado al actualizar datos del usuario!';
				$conn->close();
				header ("Location: login.php");
			}
		
}//fin de update_session


function verifi_user(){
	//codigo para verificar existencia password y usuario
	global $servername, $username, $password, $db_name, $userweb , $passweb;
	$conn = new mysqli($servername, $username, $password,$db_name);
	$stmt = $conn->prepare("SELECT * FROM master WHERE Usuarios = ?");
	$stmt->bind_param("s", $userweb);
	$stmt->execute();
	$stmt->store_result();

	if(($stmt->num_rows) > 0){
			//si existe  un resultado
			$stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7);

			while ($stmt->fetch()) 	{
				//echo 'Usuario: ',$data0,'<br>';
				//echo 'Password: ',$data1,'<br>';
				//echo 'IP_address: ',$data2,'<br>';
				//echo 'Navegadores: ',$data3,'<br>';
				//echo 'Skey almacenada: ',$data4,'<br>';
				//echo 'Estados: ',$data5,'<br>';
				//echo 'Estado de la cuenta: ',$data6,'<br>';
				//echo 'Ultima conexio: ',$data7,'<br>';

				//comparamos caracteres ya que no hay distincion entre mayuscula y minusculas
			  if ($userweb === $data0){
			      //echo 'Usuario '.$usuarios.' encontrado.';
			      if (password_verify($passweb, $data1)) {
							if ($data6 === "Habilitado"){
			        //echo "Password ok";

							//restart mensaje e intentos
			        $_SESSION['mensaje']='';
			        $_SESSION['intentos'] = 0;

			        $_SESSION['loggedin'] = true;

			        $_SESSION["usuario"]= $data0; //Usuario

							$ip = $_SERVER['REMOTE_ADDR'];
			        $hip = password_hash($ip, PASSWORD_BCRYPT);
							$_SESSION["IPaddress"] = $ip;

			        $navegador = $_SERVER['HTTP_USER_AGENT'];
			        $hnavegador = password_hash($navegador, PASSWORD_BCRYPT);
							$_SESSION["navegador"] = $navegador;

			        $Skey = uniqid(mt_rand(), true);
			        $hSkey = password_hash($Skey, PASSWORD_BCRYPT);
							$_SESSION['SKey'] = $Skey;

			        //Sesión
			        $_SESSION['start'] = time();
			        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
							$estado = 'On-line';

							//liberarresultados
			        $stmt -> free_result();

							update_session($hip, $hnavegador, $hSkey,$estado);
						}else {
							$_SESSION['mensaje']='¡Usuario deshabilitado!';
			        $stmt -> free_result();
			        $conn->close();
							$_SESSION['intentos'] ++;
			        header ("Location: login.php");
						}

			      }else {
			        $_SESSION['mensaje']='¡Verifique datos!';
			        $stmt -> free_result();
			        $conn->close();
							$_SESSION['intentos'] ++;
			        header ("Location: login.php");
			      }

			  }else {
			    //Mensaje: Verifique mayuscula, o minuculas';
			    $_SESSION['mensaje']='¡Verifique datos!';
			    $stmt -> free_result();
			    $conn->close();
					$_SESSION['intentos'] ++;
			    header ("Location: login.php");
			  }
		}
	}else {
			$stmt -> free_result();
			$conn->close();
			//echo 'Sin resultados el usuario '.$_POST['usuario'].' no existe';
			$_SESSION['mensaje']='¡Verifique datos!';
			$_SESSION['intentos'] ++;
			header ("Location: login.php");
	}


}//fin de function

function programa(){
	//verificacion de usuario y clave que contenga valores
	// codigo a ejecutar
	global $userweb , $passweb;
	if (isset($userweb) && isset($passweb)) {
		//echo 'User: '.$_POST['usuario'].'<br>';
		//echo 'Password: '.$_POST['clave'];
		//echo '<br>';
		//verifi_user(); //saltamos la comprobacion por fuerza bruta
		force_input();

	}else {
		//echo 'intento de post sin datos';
		header ("Location: ../../index.html");
	}
}

programa();
?>