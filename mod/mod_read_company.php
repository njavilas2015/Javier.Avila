<?php 
   require_once("conexion.php");
    
function get_data_company($company){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT * FROM tb_registro_de_alertas WHERE Usuarios = ? ");
	$stmt->bind_param("s", $company);
	$stmt->execute();
	$stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($data0,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8);
        

        while ($stmt->fetch()) 	{
            return $contacto = $data4 + ' ' + $data5 + ' ' + $data6;  
        }
    }    
}

function get_dir_company($company){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $stmt = $conn->prepare("SELECT DISTINCT Direccion FROM tb_empresa WHERE Usuarios = ? ");
	$stmt->bind_param("s", $company);
	$stmt->execute();
	$stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($dir);           
        while ($stmt->fetch()) 	{
            return $dir;   
        }
    }    
}

function get_cuit_company($company){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $stmt = $conn->prepare("SELECT DISTINCT CUIT FROM tb_empresa WHERE Usuarios = ? ");
	$stmt->bind_param("s", $company);
	$stmt->execute();
	$stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($cuit);           
        while ($stmt->fetch()) 	{
            return $cuit;  
        }
    } 
}

function get_logo_company($company){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $stmt = $conn->prepare("SELECT DISTINCT Directorio_img_logo FROM tb_empresa WHERE Usuarios = ? ");
    $stmt->bind_param("s", $company);
	$stmt->execute();
	$stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($logo);           
        while ($stmt->fetch()) 	{
            return $logo;
        } 
    }
}

function get_name_company(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT DISTINCT Usuarios FROM tb_empresa");
                                                                                
    $stmt->execute();
    $stmt->store_result();
    if(($stmt->num_rows) > 0){

        $stmt->bind_result($company);
        while ($stmt->fetch()) 	{
            echo'<div class="panel">
                    <div class="panel-heading">
                        Empresa: &nbsp'.($company).'
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-2">
                                <img src="/img/empresas/'.get_logo_company($company).'" style="max-width: 150px; display: inline-block;" height="100px">
                            </div>
                            <div class="col-xs-8">
                                <table width="100%" class="table" id="dataTables-example">
                                    <tbody>
                                        <tr>
                                            <th>CUIT: </th> <td>'.get_cuit_company($company).'</td>
                                            <th>Dirección: </th> <td>'.get_dir_company($company).'</td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Dirección: </th><td>'.get_data_company($company).'</td>
                                        </tr>
                                        <tr>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>';
            
        }    
        
        
    }else {echo 'No existe aún registros de empresas.';}
    
}
get_name_company();
                                                                               
?>