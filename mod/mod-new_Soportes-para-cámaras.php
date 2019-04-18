<?php
session_start();
require_once("conexion.php");
$marca                    = $_POST['marca'];
$modelo                   = $_POST['modelo'];
$material                 = $_POST['material'];
$caracteristicas_tecnicas = $_POST['caracteristicas_tecnicas'];
$caracteristicas_de_uso   = $_POST['caracteristicas_de_uso'];
$directorio               = $_POST['directorio'];
$prefijo                  = $_POST['prefijo'];

//Codigo para obtener hora y fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')." A las: ". date('h:i:s A');



function programa(){
	global $servername, $username, $password,$db_name ,$marca, $modelo, $material, $directorio, $caracteristicas_tecnicas, $caracteristicas_de_uso, $prefijo;
    if (isset($marca) 
        && isset($modelo) 
        && isset($material) 
        && isset($prefijo) 
        && isset($caracteristicas_tecnicas) 
        && isset($caracteristicas_de_uso)
        && isset($directorio)) {
        
        $nulo = null;
        $conn = new mysqli($servername, $username, $password,$db_name);
        $stmt = $conn->prepare("INSERT INTO tb_soporte (Id, Marcas,Modelos,Material,Directorio_imagen,Comentario_deposito,Comentario_venta,Prefijo_de_etiqueta ) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param('isssssss',$nulo,$marca,$modelo,$material,$directorio,$caracteristicas_tecnicas, $caracteristicas_de_uso,$prefijo);
        if ($stmt->execute()){
            $_SESSION['mensaje']='¡Éxito al registrar nuevo Soportes para cámaras!';
            echo $_SESSION['mensaje'];
            $stmt->close();
            $conn->close();
            //header ("Location: /web/pages-private/marcas-y-modelos-cctv.php");
        }else {
            $_SESSION['mensaje']='¡Error Fatal al registrar nuevo Soportes para cámaras!';
            echo $_SESSION['mensaje'];
            //header ("Location: /index.html");
            $stmt->close();
            $conn->close();
        }
	}else {
        $_SESSION['mensaje']='¡Error de procesamiento de datos. (Imposible obtener valor de variable post!';
        echo $_SESSION['mensaje'];
		//header ("Location: /index.html");
	}
}

programa();
?>