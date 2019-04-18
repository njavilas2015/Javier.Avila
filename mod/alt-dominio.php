<?php
        require_once("conexion.php");
        global $servername, $username, $password, $db_name;

                
        $conn = new mysqli($servername, $username, $password,$db_name);

        $stmt = $conn->prepare("INSERT INTO dominio (Usuarios,Dominio,Planes,Mes,Estados,Fecha_de_pago) VALUES (?,?,?,?,?,?)");
        
        $usuario = "innellajulieta@gmail.com";
        $dominio = "67d306366a50.sn.mynetname.net";
        $plan = "Mensual";
        $mes = "Abril";
        $estado = "Pago recibido";
        $fecha = "17/04/2018";

        $stmt->bind_param('ssssss',$usuario,$dominio,$plan,$mes,$estado,$fecha);
        $stmt->execute();

       
?>