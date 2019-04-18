<?php
require_once("conexion.php");

$conn = new mysqli($servername, $username, $password,$db_name);
if ($conn->connect_error) {
    $_SESSION['mensaje']='Check Connection failed:  '. $conn->connect_error;
} 

//Codigo para obtener hora y fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

function usuarios(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);

    $usuario ='Electro Centro S.A';
    $hclave = password_hash('AHUc9Yj4KbAP%', PASSWORD_BCRYPT);

    $nulo = null;
    $estado_de_cuenta = "Habilitado";
    $estado ='Off-line';
    
    $stmt = $conn->prepare("INSERT INTO master (Usuarios,Claves,IP_address,Navegadores,SKey_id,Estados,Estados_cuenta,Ultima_conexion) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssss',$usuario,$hclave,$nulo,$nulo,$nulo,$estado,$estado_de_cuenta,$nulo);
    if ($stmt->execute()){
        echo '<tr><td>Usuario '.$usuario.'</td><td>&nbsp &nbsp creado exitosamente </td></tr>';
        //Registro de usuario administrador
            
        $stmt->close();
        $conn->close();
    }else {
        echo '<tr><td>Usuario administrador </td><td>&nbsp &nbsp Imposible crear usuario o ya existe </td></tr>';
        $stmt->close();
        $conn->close();
    }
}
usuarios();
?>