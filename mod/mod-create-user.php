<?php 
session_start();
require_once("conexion.php");
$userweb = 'Roberto Coraza'; //$_POST['new-user'];
$passweb = 'QAZ123wsx2018@';//$_POST['new-password'];

global $servername, $username, $password, $db_name;
$conn = new mysqli($servername, $username, $password,$db_name);
$nulo = null;

if (isset($userweb) && isset($passweb)) {
    $hclave = password_hash($passweb, PASSWORD_BCRYPT);
    $nulo = null;
    $estado_de_cuenta = "Habilitado";
    $estado ='Off-line';
    
    $stmt = $conn->prepare("INSERT INTO master (Usuarios,Claves,IP_address,Navegadores,SKey_id,Estados,Estados_cuenta,Ultima_conexion) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssss',$userweb,$hclave,$nulo,$nulo,$nulo,$estado,$estado_de_cuenta,$nulo);
    if($stmt->execute()){
        $_SESSION['mensaje']='Alta de nuevo usuario exitoso.';
        $stmt->close();
        $conn->close();
    }else{
        $_SESSION['mensaje']='Falla Fatal: Imposible dar de Alta al nuevo usuario.';
        $stmt->close();
        $conn->close();
    }
    

}else {
    $_SESSION['mensaje']='Error de procesamiento de datos.';
    
}
?>