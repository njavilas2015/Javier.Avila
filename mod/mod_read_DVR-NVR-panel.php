<?php 
   require_once("conexion.php");
    
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $stmt = $conn->prepare("SELECT * FROM tb_dvr_nvr ");
                                                                                
    $stmt->execute();
    $stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9);
        while ($stmt->fetch()) 	{
            echo '
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Detalle de equipo Nº &nbsp'.$data0.'
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="'.$data8.'"  width="220" height="150">
                                    </div>
                                    <div class="col-xs-9">
                                        <table width="100%" class="table" id="dataTables-example">
                                            <tbody>
                                                <tr>
                                                    <th>Marca</th> <td>'.$data1.'</td>
                                                    <th>Modelo</th> <td>'.$data2.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Canal analógico</th> <td>'.$data3.'</td>
                                                    <th>Canal IP</th> <td>'.$data4.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Tecnología</th> <td>'.$data5.'</td>
                                                    <th>Prefijo de etiqueta</th> <td>'.$data9.'</td>
                                                </tr>   
                                            </tbody>
                                        </table> 
                                    </div>  
                                </div>      
                            </div>
                            <div class="panel-footer">
                                Reseña para Ventas: &nbsp &nbsp'.$data7.'
                                <br>
                                Reseña para Deposito: &nbsp &nbsp'.$data6.'
                            </div>
                        </div>
                    </div>
                </div>'
                    ;
        }                                                                        
        
    }else {echo 'No existe registros. Si desea agregar un nuevo registro &nbsp <i class="fa fa-hand-o-right fa-fw"></i> &nbsp <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-dvr-nvr" ><i class="fa fa-plus fa-fw"></i>Agregar nuevo</button>';}
                                                                                
?>