
<?php
//MODELO
    include("connect.php");  

    switch ($_GET['action']){
        case 'AgregarEmpresa':
            AgregarEmpresa();
            break;
        case 'ActualizarEmpresa':
            ActualizarEmpresa();
            break;
        case 'DeleteEmpresa':
            DeleteEmpresa();
            break;
        case 'getEmpresas':
            getEmpresas();
            break;
    }

function AgregarEmpresa(){
$data = json_decode(file_get_contents("php://input"));
    //$cl_cliente = $data->cl_cliente;
    $rfc = $data->rfc_empresa;
    $direccion = $data->direccion_empresa;
    $telefonoLocal = $data->telefono_empresa;
    $nombre = $data->nombre_empresa;
    $correo = $data->correo_empresa;
    $tamanioFlota = $data->tamanio_flota;
    
    $curp = $data->curp_admin;
    $nombre_admin = $data->nombre_admin;
    $contrasenia = $data->contrasenia_admin;
    $correo_admin = $data->correo_admin;
    $telefono = $data->telefono_admin;
                    
    $paquete = $data->paquete;

    $qry = 'INSERT INTO empresabase (rfc, direccion, telefonoLocal, nombre, correo, tamanioFlota, paquete) VALUES ("'.$rfc.'", "'.$direccion.'", "'.$telefonoLocal.'", "'.$nombre.'", "'.$correo.'", "'.$tamanioFlota.'", "'.$paquete.'")';

    $qry2 = 'INSERT INTO admin (curp,nombre,contrasenia,correo,telefono) VALUES ("'.$curp.'", "'.$nombre_admin.'", "'.$contrasenia.'", "'.$correo_admin.'", "'.$telefono.'")';


    $qry_res = mysql_query($qry);
    $qry_res2 = mysql_query($qry2);

    if($qry_res and $qry_res){
        $arr = array('msg' => "Success!!", 'error' => '');
        echo "Datos insertados ";
        $jsn = json_encode($arr);
    }
    else{
        $arr = array('msg' => "",'error' => 'Error al isertar datos');
        $jsn = json_encode($arr);
    }

    //print_r ($data);
};

function ActualizarEmpresa(){
    $data = json_decode(file_get_contents("php://input")); 
    
    $id_empresa = $data->id_empresa;
    $nombre_empresa = $data->nombre_empresa;
    $direccion_empresa = $data->direccion_empresa;
    $telefono_empresa = $data->telefono_empresa;
    $correo_empresa = $data->correo_empresa;
    $tamanio_flota = $data->tamanio_flota;
    $horario_empresa = $data->horario_empresa;
    $telefono2_empresa = $data->telefono2_empresa;

    $curp_admin = $data->curp_admin;
    $nombre_admin = $data->nombre_admin;
    $direccion_admin = $data->direccion_admin;
    $telefono_admin = $data->telefono_admin;
    $contrasenia_admin = $data->contrasenia_admin;
    $correo_admin = $data->correo_admin;

    $paquete = $data->paquete;
    
    $qry = "UPDATE empresas set nombre_empresa='".$nombre_empresa."', direccion_empresa='".$direccion_empresa."', telefono_empresa='".$telefono_empresa."', correo_empresa='".$correo_empresa."', tamanio_flota='".$tamanio_flota."', horario_empresa='".$horario_empresa."' WHERE id_empresa='".$id_empresa."'; ";
    
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Empresa actualizada Correctamente!!!", 'error' => '');
        $jsn = json_encode($arr);
        // print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error Al Actualizar Empresa');
        $jsn = json_encode($arr);
        // print_r($jsn);
    }
};

function DeleteEmpresa(){
    $data = json_decode(file_get_contents("php://input"));
        $index = $data->Empresa_index;
        $del = mysql_query("DELETE FROM empresas WHERE id_empresa = ".$index);
        if($del)
            return true;
        return false;
    };

function getEmpresas(){
    $qry = mysql_query('SELECT * from empresas') or die ("Error en consulta: " . mysql_error());
    $data = array();

    while($rows = mysql_fetch_array($qry)){
        
        //echo "The ID is: " . $row['id'] . " and the Username is: " . $row['imagen'];
        
        $data[] = array(
            "id_empresa" => $rows['id_empresa'],
            "nombre_empresa" => $rows['nombre_empresa'],
            "direccion_empresa" => $rows['direccion_empresa'],
            "telefono_empresa" => $rows['telefono_empresa'],
            "correo_empresa" => $rows['correo_empresa'],
            "tamanio_flota" => $rows['tamanio_flota'],
            "horario_empresa" => $rows['horario_empresa']
          );
        }

        /*
            $id_empresa = $data->id_empresa;
            $nombre_empresa = $data->nombre_empresa;
            $direccion_empresa = $data->direccion_empresa;
            $telefono_empresa = $data->telefono_empresa;
            $correo_empresa = $data->correo_empresa;
            $tamanio_flota = $data->tamanio_flota;
            $horario_empresa = $data->horario_empresa;
            $telefono2_empresa = $data->telefono2_empresa;

            $curp_admin = $data->curp_admin;
            $nombre_admin = $data->nombre_admin;
            $direccion_admin = $data->direccion_admin;
            $telefono_admin = $data->telefono_admin;
            $contrasenia_admin = $data->contrasenia_admin;
            $correo_admin = $data->correo_admin;

            $paquete = $data->paquete;

        */

    print_r(json_encode($data));
    return json_encode($data);
};


?>