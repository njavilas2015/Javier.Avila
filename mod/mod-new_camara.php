<?php
session_start();
require_once("conexion.php");
$marca                    = $_POST['marca'];
$modelo                   = $_POST['modelo'];
$carcasa                  = $_POST['carcasa'];
$valor_de_tension         = $_POST['valor_de_tension'];
$tecnologia               = $_POST['tecnologia'];
$directorio               = $_POST['directorio'];
$caracteristicas_tecnicas = $_POST['caracteristicas_tecnicas'];
$caracteristicas_de_uso   = $_POST['caracteristicas_de_uso'];
$prefijo                  = $_POST['prefijo'];


//Codigo para obtener hora y fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')." A las: ". date('h:i:s A');



function programa(){
	global $servername, $username, $password,$db_name ,$marca, $modelo, $carcasa, $valor_de_tension, $tecnologia, $directorio, $caracteristicas_tecnicas, $caracteristicas_de_uso, $prefijo;
	if (isset($marca) && isset($modelo) && isset($carcasa) && isset($valor_de_tension)  && isset($tecnologia) && isset($prefijo)) {
		
        $nulo = null;
        $conn = new mysqli($servername, $username, $password,$db_name);
        $stmt = $conn->prepare("INSERT INTO tb_camaras (Id, Marcas,Modelos,Tipos,Alimentacion,Tecnologias,Comentario_deposito,Comentario_venta,Directorio_imagen,Prefijo_de_etiqueta ) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('isssssssss',$nulo,$marca,$modelo,$carcasa,$valor_de_tension,$tecnologia,$caracteristicas_tecnicas, $caracteristicas_de_uso,$directorio,$prefijo);
        if ($stmt->execute()){
            $_SESSION['mensaje']='¡Éxito al registrar nueva Cámara!';
            
            $stmt->close();
            $conn->close();
            header ("Location: /web/pages-private/marcas-y-modelos-cctv.php");
        }else {
            $_SESSION['mensaje']='¡Error Fatal al registrar nueva Cámara!';
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