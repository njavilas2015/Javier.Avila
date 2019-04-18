<?php
session_start();
$now = time();
require_once("conexion.php");


//datos del visitante actual
$ip_visitante = $_SERVER['REMOTE_ADDR'];
$navegador_visitante = $_SERVER['HTTP_USER_AGENT'];



function update_close_session($estado){
	global $servername, $username, $password, $db_name;
	$conn = new mysqli($servername, $username, $password,$db_name);
	$nulo = null;
	if ($stmt = $conn->prepare("UPDATE master SET  IP_address = ?, Navegadores = ?, SKey_id = ?, Estados = ? WHERE Usuarios = ?")){
		$stmt->bind_param("sssss",$nulo,$nulo,$nulo,$estado ,$_SESSION["usuario"]);
		$stmt->execute();
    $stmt->close();
    $conn->close();
		echo 'Session user update';
		session_destroy();
        header ("Location: login.php");

  }else {
      echo 'Session user not update';
      $stmt->close();
      $conn->close();
      session_destroy();
      header ("Location: login.php");
	}

}//fin de funcion de cierre de sesion

function verificaion(){
  global $ip_visitante, $navegador_visitante,$now;
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            if($now > $_SESSION['expire']) {
                            $estado = 'Off-line';
                            update_close_session($estado);
                            //echo "Tu sesion ha expirado";

            }else{
                        //echo "Tu sesion esta correcta";
                        if(isset($_SESSION["IPaddress"]) && $_SESSION["IPaddress"] == $ip_visitante){
                                if (isset($_SESSION["navegador"]) && $_SESSION["navegador"] == $navegador_visitante ){
                                    
                                    global $servername, $username, $password, $db_name;
                                    $conn = new mysqli($servername, $username, $password,$db_name);
                                    $stmt = $conn->prepare("SELECT SKey_id FROM master WHERE Usuarios = ?");
                                    $stmt->bind_param("s", $_SESSION["usuario"]);
                                    $stmt->execute();
                                    $stmt->store_result();
                                    if(($stmt->num_rows) > 0){
                                        $stmt->bind_result($data0);
                                        while ($stmt->fetch()) 	{
                                                if (password_verify($_SESSION["SKey"], $data0)) { ?>
                                                        
                                                        
                                                        <html lang="es">
                                                            
                                                            <head>
                                                            
                                                                <meta charset="utf-8">
                                                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                                                <meta name="description" content="panel">
                                                                <meta name="author" content="Insert Mendoza">
                                                                <meta http-equiv="refresh" content="300">
                                                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
                                                            
                                                                <title>Proteccion S.A</title>
                                                            
                                                                <!-- Bootstrap Core CSS -->
                                                                <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                                                            
                                                                <!-- MetisMenu CSS -->
                                                                <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
                                                            
                                                                <!-- Custom CSS -->
                                                                <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
                                                                <!-- DataTables CSS -->
                                                                <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

                                                                <!-- DataTables Responsive CSS -->
                                                                <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

                                                                                            
                                                                                        
                                                                <!-- Custom Fonts -->
                                                                <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
                                                            
                                                                                            
                                                            
                                                                                                

                                                                <style>



                                                                .loader-page {
                                                                    position: fixed;
                                                                    z-index: 25000;
                                                                    background: rgb(255, 255, 255);
                                                                    left: 0px;
                                                                    top: 0px;
                                                                    height: 100%;
                                                                    width: 100%;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content: center;
                                                                    transition:all .3s ease;
                                                                }
                                                                .loader-page::before {
                                                                    content: "";
                                                                    position: absolute;
                                                                    border: 2px solid rgb(50, 150, 176);
                                                                    width: 60px;
                                                                    height: 60px;
                                                                    border-radius: 50%;
                                                                    box-sizing: border-box;
                                                                    border-left: 2px solid rgba(50, 150, 176,0);
                                                                    border-top: 2px solid rgba(50, 150, 176,0);
                                                                    animation: rotarload 1s linear infinite;
                                                                    transform: rotate(0deg);
                                                                }
                                                                @keyframes rotarload {
                                                                    0%   {transform: rotate(0deg)}
                                                                    100% {transform: rotate(360deg)}
                                                                }
                                                                .loader-page::after {
                                                                    content: "";
                                                                    position: absolute;
                                                                    border: 2px solid rgba(50, 150, 176,.5);
                                                                    width: 60px;
                                                                    height: 60px;
                                                                    border-radius: 50%;
                                                                    box-sizing: border-box;
                                                                    border-left: 2px solid rgba(50, 150, 176, 0);
                                                                    border-top: 2px solid rgba(50, 150, 176, 0);
                                                                    animation: rotarload 1s ease-out infinite;
                                                                    transform: rotate(0deg);
                                                                }
                                                                </style>

                                                            </head>
                                                            
                                                            <body>
                                                                                        
                                                            <div class="loader-page"></div>
                                                                                        

                                                            <div id="wrapper">
                                                            
                                                            <!-- Navigation -->
                                                            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" >
                                                                <div class="navbar-header">
                                                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                                                        <span class="sr-only">Toggle navigation</span>
                                                                        <span class="icon-bar"></span>
                                                                        <span class="icon-bar"></span>
                                                                        <span class="icon-bar"></span>
                                                                    </button>
                                                                    <a class="navbar-brand" href="index.html">Proteccion S.A</a>
                                                                    
                                                                </div>
                                                                <!-- /.navbar-header -->

                                                                <ul class="nav navbar-top-links navbar-right">
                                                                    <li class="dropdown">
                                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                            <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-messages">
                                                                            
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <strong>John Smith</strong>
                                                                                        <span class="pull-right text-muted">
                                                                                            <em>Yesterday</em>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <strong>John Smith</strong>
                                                                                        <span class="pull-right text-muted">
                                                                                            <em>Yesterday</em>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a class="text-center" href="#">
                                                                                    <strong>Abrir centro de notificaciones</strong>
                                                                                    <i class="fa fa-angle-right"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <!-- /.dropdown-messages -->
                                                                    </li>
                                                                    <!-- /.dropdown -->
                                                                    <li class="dropdown">
                                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                            <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-tasks">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <p>
                                                                                            <strong>Task 1</strong>
                                                                                            <span class="pull-right text-muted">40% Complete</span>
                                                                                        </p>
                                                                                        <div class="progress progress-striped active">
                                                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                                                                <span class="sr-only">40% Complete (success)</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <p>
                                                                                            <strong>Task 2</strong>
                                                                                            <span class="pull-right text-muted">20% Complete</span>
                                                                                        </p>
                                                                                        <div class="progress progress-striped active">
                                                                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                                                                <span class="sr-only">20% Complete</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <p>
                                                                                            <strong>Task 3</strong>
                                                                                            <span class="pull-right text-muted">60% Complete</span>
                                                                                        </p>
                                                                                        <div class="progress progress-striped active">
                                                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                                                                <span class="sr-only">60% Complete (warning)</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <p>
                                                                                            <strong>Task 4</strong>
                                                                                            <span class="pull-right text-muted">80% Complete</span>
                                                                                        </p>
                                                                                        <div class="progress progress-striped active">
                                                                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                                                                <span class="sr-only">80% Complete (danger)</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a class="text-center" href="#">
                                                                                    <strong>See All Tasks</strong>
                                                                                    <i class="fa fa-angle-right"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <!-- /.dropdown-tasks -->
                                                                    </li>
                                                                    <!-- /.dropdown -->
                                                                    <li class="dropdown">
                                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                            <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-alerts">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                                                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                                                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                                                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                                                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div>
                                                                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                                                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a class="text-center" href="#">
                                                                                    <strong>See All Alerts</strong>
                                                                                    <i class="fa fa-angle-right"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <!-- /.dropdown-alerts -->
                                                                    </li>
                                                                    <!-- /.dropdown -->
                                                                    <li class="dropdown">
                                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-user">
                                                                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                                                            </li>
                                                                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                                                            </li>
                                                                        </ul>
                                                                        <!-- /.dropdown-user -->
                                                                    </li>
                                                                    <!-- /.dropdown -->
                                                                </ul>
                                                                <!-- /.navbar-top-links -->

                                                                <div class="navbar-default sidebar" role="navigation">
                                                                    <div class="sidebar-nav navbar-collapse">
                                                                        <ul class="nav" id="side-menu">
                                                                            
                                                                            <li>
                                                                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Página principal</a>
                                                                            </li>
                                                                            
                                                                            <li>
                                                                                
                                                                            </li>
                                                                            
                                                                            

                                                                            <li>
                                                                                <a href="forms.html"><i class="fa fa-sliders fa-fw"></i> Informacíon Tecnica </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"><i class="fa fa-edit fa-fw"></i> Servicios<span class="fa arrow"></span></a>
                                                                                <ul class="nav nav-second-level">
                                                                                <li>


                                                                                    <a href="#"><i class="fa fa-lock m-auto text-primary"></i> Seguridad Informatica<span class="fa arrow"></span></a>
                                                                                    <ul class="nav nav-second-level">
                                                                                        <li>
                                                                                        <a href="index-seguridad-informatica-detalle-mikrotik.php">&nbsp &nbsp <i class="fa fa-puzzle-piece fa-fw"></i> Detalles</a>
                                                                                        </li>
                                                                                        <li>
                                                                                        <a href="index-seguridad-informatica-reporte-malicioso.php">&nbsp &nbsp <i class="fa fa-bar-chart-o fa-fw"></i> Reporte de conexiones maliciosas</a>
                                                                                        </li>
                                                                                        <li>
                                                                                        <a href="index_reporte_conex_online.php">&nbsp &nbsp  <i class="fa fa-group   fa-fw"></i> Usuarios en línea</a>
                                                                                        </li>
                                                                                                                                                        
                                                                                        <li>
                                                                                        <a href="index_reporte_conex_online.php">&nbsp &nbsp  <i class="fa fa-low-vision m-auto text-primary"></i></i> VPN Red Privada Virtual</a>
                                                                                        </li>


                                                                                    </ul>
                                                                                    
                                                                                </li>

                                                                                    
                                                                                    <li>
                                                                                    <a href="index_reporte_conex_maliciosas.php"><i class="fa fa-fax m-auto text-primary"></i> Telefonia IP</a>
                                                                                    </li>
                                                                                    <li>
                                                                                    <a href="index_reporte_conex_online.php"><i class="fa fa-video-camera   fa-fw"></i> CCTV Cámaras</a>
                                                                                    </li>
                                                                                    
                                                                                    


                                                                                </ul>
                                                                                
                                                                            </li>
                                                                            
                                                                            
                                                                            <li>
                                                                                <a href="#"><i class="fa fa-map-marker fa-fw"></i>   Por seguridad monitoreamos tu conexión <br> Tu direccion es: <?php echo $_SESSION["IPaddress"] ?><span class="fa fa-signal fa-fw"></span></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!-- /.sidebar-collapse -->
                                                                </div>
                                                                <!-- /.navbar-static-side -->
                                                            </nav>
                                                                                                    

                                                            <div id="page-wrapper">
                                                                                                        
                                                            
                                                                
                                                            
                                                                <div class="row">
                                                                    <div >
                                                                        <h2>Altas: Cliente nuevo</h2>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="panel panel-primary">
                                                                            <div class="panel-heading">
                                                                                <i class="fa fa-calendar-o fa-fw"></i> Datos Personales
                                                                            </div>
                                                                            
                                                                            <div class="panel-body" style ="overflow: auto; height: 280px;">
                                                                                
                                                                                
                                                                                <input type="text" class="form-control" id="firstName" placeholder="Nombres" value="" required><br>
                                                                                        
                                                                                <input type="text" class="form-control" id="lastName" placeholder="Apellidos" value="" required><br>
                                                                                        
                                                                                <input type="email" class="form-control" id="email" placeholder="correo@electronico.com" required><br>
                                                                                
                                                                                <input type="text" class="form-control" id="address2" placeholder="Numero telefónico con código de area" required><br>
                                                                                
                                                                                                                                                                         
                                                                                                                                                                
                                                                            </div><!--fin de panel-->
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="panel panel-primary">
                                                                            <div class="panel-heading">
                                                                                <i class="fa fa-calendar-o fa-fw"></i> Sistema de Notificacion
                                                                            </div>
                                                                            
                                                                            <div class="panel-body" style ="overflow: auto; height: 280px;">
                                                                                
                                                                                <i class="fa fa-user fa-fw"></i> <label>Usuario generado:  </label><p>Usuario generado</p><br>
                                                                                
                                                                                
                                                                                                                                                                
                                                                            </div><!--fin de panel-->
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    
                                                                    <form class="needs-validation" novalidate>
                                                                        
                                                                
                                                                                                                        
                                                                                                                               

                                                                        <!-- jQuery -->
                                                                        <script src="../vendor/jquery/jquery.min.js"></script>
                                                                        
                                                                        <!-- Bootstrap Core JavaScript -->
                                                                        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
                                                                        
                                                                        <!-- Metis Menu Plugin JavaScript -->
                                                                        <script src="../vendor/metisMenu/metisMenu.min.js"></script>
                                                                        <!-- Custom Theme JavaScript -->
                                                                        <script src="../dist/js/sb-admin-2.js"></script>
                                                                        <script src="../js/datatable.core.js"></script>
                                                                        <script src="../js/datatable.bootstrap.js"></script>
                                                                        <script type="text/javascript">
                                                                                            $(document).ready(function(){
                                                                                                                                                                                                        $("#myModal").modal('show');
                                                                                            });
                                                                            </script>


                                                                        <script>
                                                                            $(window).on("load", function () {
                                                                                                                setTimeout(function () {
                                                                                                                $(".loader-page").css({visibility:"hidden",opacity:"0"})
                                                                                                                }, 1000);
                                                                                                                
                                                                                                                setTimeout(function () {
                                                                                                                $(".myModal")}, 1000);
                                                                                                        
                                                                                                            });
                                                                        </script> 
                                                                                            
                                                                </div>
                                                            </body>
                                                            
                                                        </html>      


                                                <?php
                                                }
                                        }
                                    }

                                }else {
                                    
                                    header ("Location: login.php");
                                    close_session();
                                }
                        }else {
                            
                            session_destroy();
                            header ("Location: login.php");
                        }
            }

    }else{
        session_destroy();
        header ("Location: login.php");
    }

}//fin de funcion de verificacion

verificaion();
?>
