
<?php
//MODELO
    include("connect.php");  

    switch ($_GET['action']){
        case 'getConductores':
            getConductores();
            break;
        case 'AgregarConductor':
            AgregarConductor();
            break;
        case 'ActualizarConductor':
            ActualizarConductor();
            break;
        case 'DeleteConductor':
            DeleteConductor();
            break;
    }

function getConductores(){
    $qry = mysql_query('SELECT * from conductor') or die ("Error en consulta: " . mysql_error());
    $data = array();

    while($rows = mysql_fetch_array($qry)){
        
        //echo "The ID is: " . $row['id'] . " and the Username is: " . $row['imagen'];
        
        $data[] = array(
            "idConductor" => $rows['idConductor'],
            "licenciaConducir" => $rows['licenciaConducir'],
            "nombre" => $rows['nombre'],
            "curp" => $rows['curp'],
            "estadoCivil" => $rows['estadoCivil'],
            "sexo" => $rows['sexo']
          );
        }

    print_r(json_encode($data));
    return json_encode($data);
};


function AgregarConductor(){
$data = json_decode(file_get_contents("php://input"));
    //$cl_cliente = $data->cl_cliente;
    $nombre = $data->nombre;
    $licenciaConducir = $data->licenciaConducir;
    $curp = $data->curp;
    $estadoCivil = $data->estadoCivil;
    $sexo = $data->sexo;
    
    $qry = 'INSERT INTO conductor (nombre, licenciaConducir, curp, estadoCivil, sexo) VALUES ("'.$nombre.'", "'.$licenciaConducir.'", "'.$curp.'", "'.$estadoCivil.'", "'.$sexo.'")';

    $qry_res = mysql_query($qry);

    if($qry_res and $qry_res){
        $arr = array('msg' => "Success!!", 'error' => '');
        echo "Datos de usuario insertados ";
        $jsn = json_encode($arr);
    }
    else{
        $arr = array('msg' => "",'error' => 'Error al isertar datos');
        $jsn = json_encode($arr);
    }

    //print_r ($data);
};

function ActualizarConductor(){
    $data = json_decode(file_get_contents("php://input")); 
    
    $idConductor = $data->idConductor;
    $nombre = $data->nombre;
    $licenciaConducir = $data->licenciaConducir;
    $curp = $data->curp;
    $estadoCivil = $data->estadoCivil;
    $sexo = $data->sexo;
    
    $qry = "UPDATE conductor set nombre='".$nombre."', licenciaConducir='".$licenciaConducir."', curp='".$curp."', estadoCivil='".$estadoCivil."', sexo='".$sexo."' WHERE idConductor='".$idConductor."'; ";
    
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Usuario actualizada Correctamente!!!", 'error' => '');
        $jsn = json_encode($arr);
        // print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error Al Actualizar Usuario');
        $jsn = json_encode($arr);
        // print_r($jsn);
    }
};

function DeleteConductor(){
    $data = json_decode(file_get_contents("php://input"));
        $index = $data->Conductor_index;
        $del = mysql_query("DELETE FROM conductor WHERE idConductor = ".$index);
        if($del)
            return true;
        return false;
    };

?>