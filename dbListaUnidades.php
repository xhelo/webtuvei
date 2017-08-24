
<?php
//MODELO
    include("connect.php");  

    switch ($_GET['action']){
        case 'getListaUnidades':
            getListaUnidades();
            break;
        case 'getUnidades':
            getUnidades();
            break;
        case 'getConductores':
            getConductores();
            break;
        case 'AgregarUnidad':
            AgregarUnidad();
            break;
        case 'ActualizarListaUnidad':
            ActualizarListaUnidad();
            break;
        case 'DeleteUnidad':
            DeleteUnidad();
            break;
    }

function getListaUnidades(){
    $qry = mysql_query('SELECT * from paselistaunidades') or die ("Error en consulta: " . mysql_error());
    $data = array();

    while($rows = mysql_fetch_array($qry)){
        
        //echo "The ID is: " . $row['id'] . " and the Username is: " . $row['imagen'];
        
        $data[] = array(
            "idListaUnidad" => $rows['idListaUnidad'],
            "fecha" => $rows['fecha'],
            "economico" => $rows['economico'],
            "conductor" => $rows['conductor'],
            "estado" => $rows['estado'],
            "nota" => $rows['nota'],
          );
        }

    print_r(json_encode($data));
    return json_encode($data);
};

function getUnidades(){
    $qry = mysql_query('SELECT idUnidad,economico from unidad') or die ("Error en consulta: " . mysql_error());
    $data = array();

    while($rows = mysql_fetch_array($qry)){
        
        //echo "The ID is: " . $row['id'] . " and the Username is: " . $row['imagen'];
        
        $data[] = array(
            "idUnidad" => $rows['idUnidad'],
            "economico" => $rows['economico'],
          );
        }

    print_r(json_encode($data));
    return json_encode($data);
};

function getConductores(){
    $qry = mysql_query('SELECT idConductor,nombre from conductor') or die ("Error en consulta: " . mysql_error());
    $data = array();

    while($rows = mysql_fetch_array($qry)){
        
        //echo "The ID is: " . $row['id'] . " and the Username is: " . $row['imagen'];
        
        $data[] = array(
            "idConductor" => $rows['idConductor'],
            "nombre" => $rows['nombre']
          );
        }

    print_r(json_encode($data));
    return json_encode($data);
};


function AgregarUnidad(){
$data = json_decode(file_get_contents("php://input"));
    //$cl_cliente = $data->cl_cliente;
    $matricula = $data->matricula;
    $economico = $data->economico;
    $turno = $data->turno;
    $duenio = $data->duenio;
    $tipo = $data->tipo;
    $modelo = $data->modelo;
    
    $qry = 'INSERT INTO unidad (matricula, economico, turno, duenio, tipo, modelo) VALUES ("'.$matricula.'", "'.$economico.'", "'.$turno.'", "'.$duenio.'", "'.$tipo.'", "'.$modelo.'")';

    $qry_res = mysql_query($qry);

    if($qry_res and $qry_res){
        $arr = array('msg' => "Success!!", 'error' => '');
        echo "Datos de unidad insertados ";
        $jsn = json_encode($arr);
    }
    else{
        $arr = array('msg' => "",'error' => 'Error al isertar datos');
        $jsn = json_encode($arr);
    }

    //print_r ($data);
};


function ActualizarListaUnidad(){
    $data = json_decode(file_get_contents("php://input")); 
    
    $fecha = $data->fecha;
    
    $idUnidad = $data->idUnidad;
    $idUnidad = "01";
    $economico = $data->economico;
    //$idConductor = $data->idConductor;
    //$nombre = $data->nombre;
    $nombre = "Juan";
    $estado = $data->estado;
    $nota = $data->nota;
    
    $qry = "UPDATE paselistaunidades set conductor='".$nombre."', estado='".$estado."', nota='".$nota."' WHERE economico='".$economico."'; ";
    
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Lista de Unidad actualizada Correctamente!!!", 'error' => '');
        $jsn = json_encode($arr);
        // print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error Al Actualizar Lista de Unidad');
        $jsn = json_encode($arr);
        // print_r($jsn);
    }
};

function DeleteUnidad(){
    $data = json_decode(file_get_contents("php://input"));
        $index = $data->Unidad_index;
        $del = mysql_query("DELETE FROM unidad WHERE idUnidad = ".$index);
        if($del)
            return true;
        return false;
    };

?>