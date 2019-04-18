<?php 
   require_once("conexion.php");
    
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $stmt = $conn->prepare("SELECT * FROM tb_stock ");
                                                                                
    $stmt->execute();
    $stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9,$data10,$data11,$data12);
        while ($stmt->fetch()) 	{
            echo '
                <div class="row">
                    <div class="col-lg-12">
                    <div class="row">
                    
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Registro</th>
                                                <th>Fecha de registro</th>
                                                <th>Usuario de regitro</th>
                                                <th>Fecha de ingreso</th>
                                                <th>Origen</th>
                                                <th>Fecha de salida</th>
                                                <th>Destino</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            
                        
                    </div>
                </div>'
                    ;
        }                                                                        
        
    }else {echo 'No existe registros. Si desea agregar un nuevo registro de Stock &nbsp <i class="fa fa-hand-o-right fa-fw"></i> &nbsp <button type="button"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-camara" ><i class="fa fa-plus fa-fw"></i>Agregar nuevo</button>';}
                                                                                
?>