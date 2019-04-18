<?php
session_start();
require_once('conexion.php');
$userweb = $_SESSION['usuario'];

$nulo = null;
$estado_de_cuenta = "Habilitado";
$estado = 'Off-line';

$usuario = 'Electro Centro S.A';
$hclave = password_hash('AHUc9Yj4KbAP%', PASSWORD_BCRYPT);

$nulo = null;
$estado_de_cuenta = "Habilitado";
$estado = 'Off-line';

$conn = new mysqli($servername, $username, $password, $db_name);
$stmt = $conn->prepare("INSERT INTO master (Usuarios,Claves,IP_address,Navegadores,SKey_id,Estados,Estados_cuenta,Ultima_conexion) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param('ssssssss', $usuario, $hclave, $nulo, $nulo, $nulo, $estado, $estado_de_cuenta, $nulo);
if ($stmt->execute()) {
    echo '<tr><td>Usuario administrador </td><td>&nbsp &nbsp OK </td></tr>';
    $stmt->close();
    $conn->close();
} else {
    echo '<tr><td>Usuario administrador </td><td>&nbsp &nbsp Fail </td></tr>';
    $stmt->close();
    $conn->close();
}
 