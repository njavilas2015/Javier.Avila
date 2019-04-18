<?php 
   require_once("conexion.php");
    
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);

    $stmt = $conn->prepare("SELECT * FROM tb_registro_de_equipos WHERE Usuarios = ?");
	$stmt->bind_param("s", $_SESSION["usuario"]);
	                                                                    
    $stmt->execute();
    $stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9,$data10);
        while ($stmt->fetch()) 	{
            echo '
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Estado:  '.$data9.'
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <img src="'.$data2.'" width="220" height="150">
                                        </div>
                                        <div class="col-xs-3">
                                            <table width="100%" class="table" id="dataTables-example">
                                                <tbody>
                                                    <tr>
                                                        <th>Ubicacion del equipo: </th> <td>'.$data6.'</td>
                                                        <th>IP: </th> <td>'.$data3.'</td>
                                                    </tr>
                                                    <tr>
                                                        <th>MAC: </th> <td>'.$data5.'</td>
                                                        <th>Tunel VPN: </th> <td>'.$data4.'</td>
                                                    </tr>
                                                    <tr>
                                                        <th>límite de velocidad</th> <td>'.$data8.'</td>
                                                        <th>Prefijo de etiqueta</th> <td>'.$data9.'</td>
                                                    </tr>   
                                                    <tr>
                                                        <th>Aviso por desconexión: </th> <td>'.$data10.'</td>
                                                    </tr>  
                                                </tbody>
                                            </table> 
                                        </div>  
                                    </div>      
                                </div>
                                <div class="panel-footer">
                                    Uso futuro para observar detalles de rendimiento de sistema
                                </div>
                            </div>
                        </div>
                    </div>'
                    ;
        }                                                                        
        
    }else {echo 'No existe registro';}
                                                                                
?>