<?php
session_start();
require_once("conexion.php");
$marca                    = $_POST['marca'];
$modelo                   = $_POST['modelo'];
$chanalog                 = $_POST['chanalog'];
$chip                     = $_POST['chip'];
$tecnologia               = $_POST['tecnologia'];
$caracteristicas_tecnicas = $_POST['caracteristicas_tecnicas'];
$caracteristicas_de_uso   = $_POST['caracteristicas_de_uso'];
$directorio               = $_POST['directorio'];
$prefijo                  = $_POST['prefijo'];


//Codigo para obtener hora y fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')." A las: ". date('h:i:s A');



function programa(){
	global $servername, $username, $password,$db_name ,$marca, $modelo, $chanalog, $chip, $tecnologia, $directorio, $caracteristicas_tecnicas, $caracteristicas_de_uso, $prefijo;
	if (isset($marca) && isset($modelo) && isset($chanalog) && isset($chip)  && isset($tecnologia) && isset($prefijo) && isset($caracteristicas_tecnicas) && isset($caracteristicas_de_uso)) {
		
        $nulo = null;
        $conn = new mysqli($servername, $username, $password,$db_name);
        $stmt = $conn->prepare("INSERT INTO tb_dvr_nvr (Id, Marcas,Modelos,CHanalog,CHip,Tecnologias,Comentario_deposito,Comentario_venta,Directorio_imagen,Prefijo_de_etiqueta ) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('isssssssss',$nulo,$marca,$modelo,$chanalog,$chip,$tecnologia,$caracteristicas_tecnicas, $caracteristicas_de_uso,$directorio,$prefijo);
        if ($stmt->execute()){
            $_SESSION['mensaje']='¡Éxito al registrar nuevo DVR-NVR!';
            
            $stmt->close();
            $conn->close();
            header ("Location: /web/pages-private/marcas-y-modelos-cctv.php");
        }else {
            $_SESSION['mensaje']='¡Error Fatal al registrar nuevo DVR-NVR!';
            header ("Location: /index.html");
            $stmt->close();
            $conn->close();
        }
	}else {
        $_SESSION['mensaje']='¡Error de procesamiento de datos. (Imposible obtener valor de variable post!';
		header ("Location: /index.html");
	}
}

programa();
?>