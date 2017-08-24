
<?php
//MODELO
    include("connect.php");  

    switch ($_GET['action']){
        case 'getPaseLista':
            getPaseLista();
            break;
        case 'getCalles':
            getCalles();
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

function getPaseLista(){
    $qry = mysql_query('SELECT * from paselista') or die ("Error en consulta: " . mysql_error());
    $data = array();

    while($rows = mysql_fetch_array($qry)){
        
        //echo "The ID is: " . $row['id'] . " and the Username is: " . $row['imagen'];
        
        $data[] = array(
            "idPaseLista" => $rows['idPaseLista'],
            "fecha" => $rows['fecha'],
            "economico" => $rows['economico'],
            "ubicacion" => $rows['ubicacion'],
            "status" => $rows['status'],
            "cliente" => $rows['cliente'],
          );
        }

    print_r(json_encode($data));
    return json_encode($data);
};

function getCalles(){
    $qry = mysql_query('SELECT * from calle') or die ("Error en consulta: " . mysql_error());
    $data = array();

    while($rows = mysql_fetch_array($qry)){
        
        //echo "The ID is: " . $row['id'] . " and the Username is: " . $row['imagen'];
        
        $data[] = array(
            "idCalle" => $rows['idCalle'],
            "nombre" => $rows['nombre'],
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
    
    $idPaseLista = $data->idPaseLista;
    $fecha = $data->fecha;
    
    $hora = $data->hora;
    $economico = $data->economico;
    $ubicacion = $data->ubicacion;
    $status = $data->status;
    $cliente = $data->cliente;
    
    $qry = "UPDATE paselista set economico='".$economico."', ubicacion='".$ubicacion."', status='".$status."', cliente='".$cliente."' WHERE idPaseLista='".$idPaseLista."'; ";
    
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Unidad actualizada Correctamente!!!", 'error' => '');
        $jsn = json_encode($arr);
        // print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error Al Actualizar Unidad');
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