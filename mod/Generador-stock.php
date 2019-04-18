#Generador de tablas para base de datos de vantas y stock


function tb_stock(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_stock (
                                        Id_movimiento               int (254) AUTO_INCREMENT PRIMARY KEY,
                                        Fecha_movimiento            VARCHAR(254),
                                        Usuario_movimiento          VARCHAR(254),
                                       
                                        Categoria                   VARCHAR(254),
                                        Sub_categoria               VARCHAR(254),
                                        Tabla_asociaada             VARCHAR(254),
                                        Id_producto                 VARCHAR(254),
                                        
                                        Fecha_ingreso               VARCHAR(254),
                                        Usuario_ingreso             VARCHAR(254),
                                        Origen_ingreso              VARCHAR(254),

                                        Fecha_salida                VARCHAR(254),
                                        Usuario_salida              VARCHAR(254),
                                        Destino_salida              VARCHAR(254)     
                                                    )";
    
    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: stock </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: stock</td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de funcion
//--------------------------------------------------------------------------------------------

//Tabla Marcas y Modelos de cámaras

function tb_camaras(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_camaras (
                                                    Id                        int (254) AUTO_INCREMENT PRIMARY KEY,
                                                    Marcas                    VARCHAR(254),
                                                    Modelos                   VARCHAR(254),
                                                    Tipos                     VARCHAR(254),
                                                    Alimentacion              VARCHAR(254),
                                                    Tecnologias               VARCHAR(254),
                                                    Comentario_deposito       VARCHAR(254),
                                                    Comentario_venta          VARCHAR(254),
                                                    Directorio_imagen         VARCHAR(254),
                                                    Prefijo_de_etiqueta       VARCHAR(254)
                                                    )";

    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: Cámaras </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: Cámaras </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de funcion
//--------------------------------------------------------------------------------------------


//Tabla Marcas y Modelos de DVR y NVR

function tb_dvr_nvr(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_dvr_nvr (
                                                    Id                        int (254) AUTO_INCREMENT PRIMARY KEY,
                                                    Marcas                    VARCHAR(254),
                                                    Modelos                   VARCHAR(254),
                                                    CHanalog                  VARCHAR(254),
                                                    CHip                      VARCHAR(254),
                                                    Tecnologias               VARCHAR(254),
                                                    Comentario_deposito       VARCHAR(254),
                                                    Comentario_venta          VARCHAR(254),
                                                    Directorio_imagen         VARCHAR(254),
                                                    Prefijo_de_etiqueta       VARCHAR(254)
                                                    )";

    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: Marcas y Modelos  DVR - NVR </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: Marcas y Modelos  DVR - NVR </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de funcion
//--------------------------------------------------------------------------------------------


//Tabla Marcas y Modelos de soporte para soportes

function tb_soporte(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_soporte (
                                                    Id                        int (254) AUTO_INCREMENT PRIMARY KEY,
                                                    Marcas                    VARCHAR(254),
                                                    Modelos                   VARCHAR(254),
                                                    Material                  VARCHAR(254),
                                                    Directorio_imagen         VARCHAR(254),
                                                    Comentario_deposito       VARCHAR(254),
                                                    Comentario_venta          VARCHAR(254),
                                                    Prefijo_de_etiqueta       VARCHAR(254)
                                                    )";

    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: Marcas y Modelos  de soporte para cámaras </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: Marcas y Modelos  de soporte para cámaras </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de funcion
//--------------------------------------------------------------------------------------------


//Tabla Marcas y Modelos de soporte para lentes


function tb_lentes(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_lentes (
                                                    Id                        int (254)AUTO_INCREMENT PRIMARY KEY,
                                                    Marcas                    VARCHAR(254),
                                                    Modelos                   VARCHAR(254),
                                                    Tecnologias               VARCHAR(254),
                                                    Prefijo_de_etiqueta       VARCHAR(254)
                                                    )";

    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: Marcas y Modelos  de soporte para cámaras </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: Marcas y Modelos  de soporte para cámaras </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de Marcas y Modelos de soporte para cámaras

//-------------------------------fin----------de------------------CCTV------------------------




//------------------------Comienzo----------de------------------CDA------------------------

//Tabla paneles y teclados
//Actualizacíon 28/11/18

function tb_paneles_teclado(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_paneles_teclado (
                                                            Id                        int (254) AUTO_INCREMENT PRIMARY KEY,
                                                            Marcas                    VARCHAR(254),
                                                            Modelos                   VARCHAR(254),
                                                            Tipo_de_ambiente          VARCHAR(254),
                                                            Tecnologias               VARCHAR(254),
                                                            Prefijo_de_etiqueta       VARCHAR(254)
                                                            )";

    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: Marcas y Modelos  de soporte para cámaras </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: Marcas y Modelos  de soporte para cámaras </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de paneles y teclados



//Tabla Cerraduras eléctricas y herrajes

function tb_cerraduras_herrajes(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_cerraduras_herrajes (
                                                                Id                        int (254) AUTO_INCREMENT PRIMARY KEY,
                                                                Marcas                    VARCHAR(254),
                                                                Modelos                   VARCHAR(254),
                                                                Tecnologias               VARCHAR(254),
                                                                Prefijo_de_etiqueta       VARCHAR(254)
                                                                )";

    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: Cerraduras eléctricas y herrajes </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: Cerraduras eléctricas y herrajes </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de tabla de Cerraduras eléctricas y herrajes

//Tabla Pulsadores

function tb_pulsadores(){
    global $servername, $username, $password, $db_name;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "CREATE TABLE tb_pulsadores (         
                                                        Id                        int (254) AUTO_INCREMENT PRIMARY KEY,
                                                        Marcas                    VARCHAR(254),
                                                        Modelos                   VARCHAR(254),
                                                        Tecnologias               VARCHAR(254),
                                                        Prefijo_de_etiqueta       VARCHAR(254)
                                                                )";

    if ($conn->query($sql) === TRUE) {
        echo '<tr><td>Tabla: Pulsadores </td><td>&nbsp &nbsp OK </td></tr>';
        $conn->close();
    }else {
        echo '<tr><td>Tabla: Pulsadores </td><td>&nbsp &nbsp  Error al crear ó Ya existe  </td></tr>';
        $conn->close();
    }   

}//fin de tabla de Pulsadores


//--------------------------------------------------------------------------------------------
