<?php
//Generador de Base de datos y Tablas del sistema.
//Version 5.1
//Autor: Avila Javier
//Insert Mendoza
$servername = "localhost";
$username = "administrador";
$password = "QAZ123wsx2018@";
$db_name = "insert_mendoza";

$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
    $_SESSION['mensaje'] = 'Check Connection failed:  ' . $conn->connect_error;
}

//Codigo para obtener hora y fecha
$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$fecha = $dias[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y');

//--------------------------------------------------------------------------------------------
//Tabla datos de la empresa
function limpia_espacios($cadena)
{
    $cadena = str_replace(' ', '', $cadena);
    return $cadena;
}
function tb_empresa()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE tb_empresa (
                                        Id                    int (254) AUTO_INCREMENT PRIMARY KEY,
                                        Usuarios              VARCHAR(254),
                                        CUIT                  VARCHAR(254),
                                        Direccion             VARCHAR(254),
                                        Directorio_img_logo   VARCHAR(254))";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: datos de la empresa </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: datos de la empresa</td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion

function tb_service()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE tb_service (
                                        Id                    int (254) AUTO_INCREMENT PRIMARY KEY,
                                        Usuarios              VARCHAR(254),
                                        Servicio              VARCHAR(254),
                                        Estado                VARCHAR(254),
                                        Fecha                 VARCHAR(254),
                                        Monto                 VARCHAR(254),
                                        Modalidad             VARCHAR(254))";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: tb_service </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: tb_service</td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion

function contabilidad()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE contabilidad (
                                        Id                    int (254) AUTO_INCREMENT PRIMARY KEY,
                                        Usuarios              VARCHAR(254),

                                        Fecha                 VARCHAR(254),
                                        Pto_venta             VARCHAR(254),
                                        Factura               VARCHAR(254),
                                        Concepto              VARCHAR(254),
                                        Monto                 VARCHAR(254),
                                        Empresa               VARCHAR(254),
                                        
                                        Estado                VARCHAR(254),
                                        Deuda                 VARCHAR(254),

                                        Nota_debito           VARCHAR(254),
                                        
                                        Nota_credito          VARCHAR(254) )";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: contabilidad </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: contabilidad </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion

function tb_contacto()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE tb_contacto (
                                        Id                    int (254) AUTO_INCREMENT PRIMARY KEY,
                                        Usuarios              VARCHAR(254),
                                        Contacto              VARCHAR(254),
                                        Telefono              VARCHAR(254),
                                        Email                 VARCHAR(254),
                                        Email_de_notification VARCHAR(254))";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: datos de la empresa </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: datos de la empresa</td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion


//--------------------------------------------------------------------------------------------

//registros de usuarios web
function tabla_master()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);

    $sql = "CREATE TABLE master (
                                    Usuarios       VARCHAR(254) PRIMARY KEY,
                                    Claves         VARCHAR(254),
                                    IP_address     VARCHAR(254),
                                    Navegadores    VARCHAR(254),
				                    SKey_id        VARCHAR(254),
                                    Estados        VARCHAR(254),
                                    Estados_cuenta VARCHAR(254),
                                    Ultima_conexion VARCHAR(254)
                                    )";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: Master para usuarios web </td><td>&nbsp &nbsp OK </td></tr>';


        $stmt->close();
        $conn->close();
    } else {
        echo '<tr><td>Tabla: Master para usuarios web </td><td>&nbsp &nbsp  Error al crear ó Ya existe </td></tr>';
        //Si se vuelve a ejecutar el codigo no remplaza el usuario adminstrador
        $conn->close();
    }
} //fin de funcion
//--------------------------------------------------------------------------------------------
function usuarios()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);

    $usuario = 'Insert';
    $hclave = password_hash('QAZ123wsx2018@', PASSWORD_BCRYPT);

    $nulo = null;
    $estado_de_cuenta = "Habilitado";
    $estado = 'Off-line';

    $stmt = $conn->prepare("INSERT INTO master (Usuarios,Claves,IP_address,Navegadores,SKey_id,Estados,Estados_cuenta,Ultima_conexion) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssss', $usuario, $hclave, $nulo, $nulo, $nulo, $estado, $estado_de_cuenta, $nulo);
    if ($stmt->execute()) {
        echo '<tr><td>Usuario ' . $usuario . '</td><td>&nbsp &nbsp creado exitosamente </td></tr>';
        //Registro de usuario administrador

        $stmt->close();
        $conn->close();
    } else {
        echo '<tr><td>Usuario administrador </td><td>&nbsp &nbsp Imposible crear usuario o ya existe </td></tr>';
        $stmt->close();
        $conn->close();
    }
}

//Tabla registro de alertas 

function tb_registro_de_alertas()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE tb_registro_de_alertas (  
                                                Id                  int (254) AUTO_INCREMENT PRIMARY KEY,
                                                Usuarios            VARCHAR(254),
                                                Mensajes            VARCHAR(254),
                                                Categorias          VARCHAR(254),
                                                Fecha               VARCHAR(254),
                                                Hora                VARCHAR(254),
                                                Comment             VARCHAR(254),
                                                Ubicacion           VARCHAR(254)
                                                
                                                )";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: registro de alertas </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: registro de alertas </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion
//--------------------------------------------------------------------------------------------

//Tabla informacion del sistema 

function tb_info_system_server()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE tb_info_system_server (  
                                                Id                       int (254) AUTO_INCREMENT PRIMARY KEY,
                                                Usuarios                 VARCHAR(254),
                                                Sistema_operativo        VARCHAR(254),
                                                Distribucion             VARCHAR(254),
                                                Fecha_instalacion        VARCHAR(254),
                                                Proximo_mantenimiento    VARCHAR(254),
                                                Procesador               VARCHAR(254),
                                                Nucleos                  VARCHAR(254),
                                                Nucleos_logicos          VARCHAR(254),
                                                Memoria_RAM_instalada    VARCHAR(254),
                                                Memoria_RAM_free         VARCHAR(254),
                                                Memoria_RAM_usage        VARCHAR(254),
                                                Ubicacion                VARCHAR(254),
                                                Licencia                 VARCHAR(254),
                                                Raid                     VARCHAR(254)

                                                
                                                )";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: informacion del sistema </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: informacion del sistema  </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion
//--------------------------------------------------------------------------------------------

//Tabla registro de equipos  

function tb_registro_de_equipos()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE tb_registro_de_equipos (  
                                                Id                  int (254) AUTO_INCREMENT PRIMARY KEY,
                                                Usuarios            VARCHAR(254),
                                                Tipo_dispositivo    VARCHAR(254),
                                                Ip                  VARCHAR(254),
                                                VPN                 VARCHAR(254),
                                                MAC                 VARCHAR(254),
                                                Ubicacion           VARCHAR(254),
                                                Comment             VARCHAR(254),
                                                Limite_de_velocidad VARCHAR(254),
                                                Estados             VARCHAR(254),                                                                                                                                                                                                                                                                                                                                                               
                                                Test                VARCHAR(254)
                                                
                                                )";
    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: registro de equipos </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: registro de equipos </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion
//--------------------------------------------------------------------------------------------

//Tabla dominio 

function dominio()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE dominio (
                                    Usuarios            VARCHAR(254),
                                    Dominio             VARCHAR(254),
                                    Planes              VARCHAR(254),
                                    Mes                 VARCHAR(254),
                                    Estados             VARCHAR(254),
                                    Fecha_de_pago       VARCHAR(254)
                                    )";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: dominio </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: dominio </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }
} //fin de funcion
//--------------------------------------------------------------------------------------------

//Tabla mikrotik

function mikrotik()
{
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password, $db_name);
    $sql = "CREATE TABLE mikrotik (
                                    Id                  int (254) AUTO_INCREMENT PRIMARY KEY,
                                    Usuarios            VARCHAR(254),
                                    Ubicaciones         VARCHAR(254),
                                    User                VARCHAR(254),
                                    Passwords           VARCHAR(254),
                                    Dominio             VARCHAR(254),
                                    IP                  VARCHAR(254),
                                    Puerto              VARCHAR(254)
                                    )";

    if ($conn->query($sql) === true) {
        echo '<tr><td>Tabla: Mikrotik </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    } else {
        echo '<tr><td>Tabla: Mikrotik </td><td>&nbsp &nbsp  Error al crear ó Ya existe </td></tr>';
        $conn->close();
    }
} //fin registros de servicios

//--------------------------------------------------------------------------------------------

function programa()
{
    global $servername, $username, $password, $db_name, $fecha;

    echo '<h3>Bienvenido Web Master ' . $fecha . '</h3>';
    $conn = new mysqli($servername, $username, $password);
    $sql = "CREATE DATABASE $db_name COLLATE utf8_spanish_ci ";
    echo '<table>
            <tr>
                <td>Procesos</td>
                <td>&nbsp &nbsp Estados</td>
            </tr>';

    if ($conn->query($sql) === true) {
        echo '<tr><td> Alta                         </td><td>               </td></tr>';
        echo '<tr><td> Base de datos: ' . $db_name . '</td><td>&nbsp &nbsp OK </td></tr>';

        tb_empresa();
        tb_contacto();
        tabla_master();
        usuarios();
        dominio();
        tb_service();

        mikrotik();
        tb_registro_de_equipos();
        tb_registro_de_alertas();
        tb_info_system_server();
        contabilidad();
    } else {
        echo '<tr><td> Actualizacíon del sistema    </td><td>               </td></tr>';
        echo '<tr><td> Base de datos: ' . $db_name . '</td><td>&nbsp &nbsp Error al crear ó Ya existe </td></tr>';

        tb_empresa();
        tb_contacto();
        tabla_master();
        usuarios();
        dominio();
        tb_service();
        contabilidad();

        mikrotik();
        tb_registro_de_equipos();
        tb_registro_de_alertas();
        tb_info_system_server();
    }
} //Fin de funcíon programa()

programa();
