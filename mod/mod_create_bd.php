<?php
$servername = "localhost";
$username = "administrador";
$password = "QAZ123wsx2018@";
$db_name = "insert_mendoza";

$conex = array(
                        "Server"  => "",
                        "Port"  => "",
                        "User"  => "",
                        "Password"  => "",
                        "db" => "",
                    );


function programa(){
    global $conex;
    $db_name = $conex["Server"];
    $conn = new mysqli($conex["Server"], $conex["User"], $conex["Password"]);
    $sql = "CREATE DATABASE $db_name COLLATE utf8_spanish_ci ";
    if ($conn->query($sql) === TRUE) {
            
            
    }else{
                
    }
    
}




?>