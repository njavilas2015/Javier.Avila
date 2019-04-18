<?php 
   require_once("conexion.php");
    
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);

    $stmt = $conn->prepare("SELECT * FROM tb_info_system_server WHERE Usuarios = ?");
	$stmt->bind_param("s", $_SESSION["usuario"]);
	                                                                    
    $stmt->execute();
    $stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9,$data10,$data11,$data12,$data13,$data14);
        while ($stmt->fetch()) 	{
            echo '
            <div class="col-lg-12" >
                                                                   
                <div class="panel panel-primary">
                    <div class="panel-heading"><span id="lang_002">Al servicio de: '.$data1.' Servidor Nº: '.$data0.'</span></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="vitals" class="table table-hover table-condensed noborderattop">
                                <tbody>
                                    <tr>
                                        <th><span id="lang_003">Sistema Operativo</span></th>
                                        <td><span >Servidor '.$data2.'</span></td>
                                    
                                        <th><span id="lang_006">Distribución</span></th>
                                        <td><span data-bind="Distro"> '.$data3.'</span></td>
                                    </tr>
                                    <tr>
                                        <th><span id="lang_007">El Servidor fue instalado</span></th>
                                        <td>'.$data4.'</td>
                                    
                                        <th><span id="lang_006">En</span></th>
                                        <td><span data-bind="Distro"> '.$data12.'</span></td>
                                    </tr>
                                    <tr>
                                        <th><span id="lang_095">Mantenimeinto programado para el día:  </span></th>
                                        <td><span data-bind="LastBoot">'.$data5.'</span></td>
                                    
                                        <th><span id="lang_095">y para el día:  </span></th>
                                        <td><span data-bind="LastBoot">Automático</span></td>
                                    </tr>

                                    <tr>
                                        <th><span id="lang_008">Microprocesador instalado</span></th>
                                        <td><span data-bind="Users">'.$data6.'</span></td>
                                    
                                        <th><span id="lang_008">Raid de disco</span></th>
                                        <td><span data-bind="Users">'.$data14.'</span></td>
                                    </tr>

                                    <tr>
                                        <th><span id="lang_008">Nucleos</span></th>
                                        <td><span data-bind="Users">'.$data7.'</span></td>
                                   
                                        <th><span id="lang_008">Nucleos lógicos</span></th>
                                        <td><span data-bind="Users">'.$data8.'</span></td>
                                    </tr>
                                    <tr>
                                        <th><span id="lang_008">Memoria RAM instalada </span></th>
                                        <td><span data-bind="Users">'.$data9.' GB </span></td>
                                    
                                        <th><span id="lang_097">Ram Libre</span></th>
                                        <td><span data-bind="SysLang">'.$data10.'GB</span></td>
                                    </tr>
                                    <tr>
                                        <th><span id="lang_009">Uso de Memoria Ram</span></th>
                                        <td><span data-bind="LoadAvg">'.$data11.' GB 
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: '. (($data11 * 100)/$data9).'%">
                                               
                                            </div>
                                        </div>
                                        
                                        <span></td>
                                   
                                        <th><span id="lang_098">Licencia servidor</span></th>
                                        <td><span data-bind="CodePage">'.$data13.'</span></td>
                                    </tr>
                                    
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>'
                    ;
        }                                                                        
        
    }else {echo 'No existe registro';}
                                                                                
?>