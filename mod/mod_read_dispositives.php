<?php 
   require_once("conexion.php");
    
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $stmt = $conn->prepare("SELECT * FROM tb_registro_de_equipos ");
                                                                                
    $stmt->execute();
    $stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9,$data10);
        

        while ($stmt->fetch()) 	{
            echo'    
                <div class="panel">    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-2">
                                <img src="/img/'.$data2.'" style="max-width: 150px; display: inline-block;"  height="100px">
                            </div>
                            <div class="col-xs-8">
                                <table width="100%" class="table" id="dataTables-example">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">'.$data7.'</td> <td></td>
                                            
                                        </tr>
                                        <tr>
                                            <th>IP: </th> <td>'.$data3.'</td>
                                            <th>MAC: </th> <td>'.$data5.'</td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Ubicación</th> <td colspan="3">'.$data6.'</td>    
                                        </tr>
                                      
                                    </tbody>
                                </table> 
                            </div> 
                        </div> 
                    </div>      
                </div>
        
            ';
            
        }    
        
    }else {echo 'No existe registros.';}
                                                                                
?>