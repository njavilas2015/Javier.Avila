<?php
session_start();
$_SESSION['intentos'] = 0;
$_SESSION['mensaje']='Tu cuenta ha sido restaurada.<br>Recuerda que solo posees 3 intentos.';
header ("Location: index.php");
?>
