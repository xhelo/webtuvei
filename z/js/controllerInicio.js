
	var app = angular.module('myApp', []); 
	app.controller('myCtrl', ['$scope','$http', function ($scope, $http, $modal){

		//Lista de empresas
	    $scope.empresas = [];

	    //Datos de la empresa Base
		$scope.claveTuvei = ""; //id
		$scope.rfc_empresa= ""; 
		$scope.direccion_empresa = "";
		$scope.telefonoLocal_empresa = "";
		$scope.nombre_empresa= "";
		$scope.correo_empresa = "";
		$scope.tamanio_flota = "";
		//$scope.horario_empresa = "";
		//$scope.telefono2_empresa = "";
		$scope.idAdmin = "";

		$scope.curp_admin = "";
		$scope.nombre_admin = "";
		$scope.contrasenia_admin = "";
		$scope.correo_admin = "";
		$scope.telefono_admin ="";
		//$scope.direccion_admin = "";
		
		$scope.paquete = "";

		$scope.iniciarRegistro = function (){
			console.log("Usuario agregado");
    		$('#modalFinalizado').modal('hide'); //Cerrar modal de Bootstrap
    		//$scope.registrarEmpresa();
    		//$("#modalRegistradoExito").modal(); //Abrir modal
		}

		$scope.registrarEmpresa = function(){
			console.log("Se llamó a registrarEmpresa");
	        $http.post('dbRegistroTUVEI.php?action=AgregarEmpresa', {
	                'rfc_empresa': $scope.rfc_empresa,
	                'direccion_empresa': $scope.direccion_empresa,
	                'telefono_empresa': $scope.telefonoLocal_empresa,
	                'nombre_empresa': $scope.nombre_empresa,
	                'correo_empresa': $scope.correo_empresa,
	                'tamanio_flota': $scope.tamanio_flota,

	                'curp_admin': $scope.curp_admin,
	                'nombre_admin' : $scope.nombre_admin,
	                'contrasenia_admin' : $scope.contrasenia_admin,
	                'correo_admin' : $scope.correo_admin,
	                'telefono_admin' : $scope.telefono_admin,
	                //'direccion_admin' : $scope.direccion_admin,
	                
	                'paquete' : $scope.paquete,
	            })
	            .then(function (data, status, headers, config) {
	                //Abrimos modal de registro exitoso
	                $('#modalFinalizado').modal('hide'); //Cerrar modal de Bootstrap
		    		$("#modalRegistradoExito").modal(); //Abrir modal
	            })
	            .catch(function (data, status, headers, config) {

	            });
    	};

    	$scope.prueba = function(){
    		console.log("Usuario agregado");
    		$('#modalFinalizado').modal('hide'); //Cerrar modal de Bootstrap
    		$("#modalRegistradoExito").modal(); //Abrir modal
    	}

    	$scope.actualizarEmpresa = function () {
	        $http.post("dbRegistroTUVEI.php?action=ActualizarEmpresa", {
	                'id_libro': $scope.id_libro,
	                
	                'rfc_empresa': $scope.rfc_empresa,
	                'nombre_empresa': $scope.nombre_empresa,
	                'direccion_empresa': $scope.direccion_empresa,
	                'telefono_empresa': $scope.telefono_empresa,
	                'correo_empresa': $scope.correo_empresa,
	                'tamanio_flota': $scope.tamanio_flota,
	                'horario_empresa' : $scope.horario_empresa,
	                'telefono2_empresa' : $scope.telefono2_empresa,

	                'curp_admin' : $scope.curp_admin,
	                'nombre_admin' : $scope.nombre_admin,
	                'direccion_admin' : $scope.direccion_admin,
	                'telefono_admin' : $scope.telefono_admin,
	                'contrasenia_admin' : $scope.contrasenia_admin,
	                'correo_admin' : $scope.correo_admin,

	                'paquete' : $scope.paquete,
	            })
	            .success(function (data, status, headers, config) {
	                //$scope.showForm(); //Ocultar formulario
	                //$scope.getEmpresas(); //Volver a cargar los datos
	                //$scope.actualizarInfo(); //En caso de realizar otra acción
	                
	                //$scope.limpiarFormulario(); //Limpiar formularios de actualizado
	                //$('#modalLibroActualizado').foundation('open'); //Mostar modal de actualizado dependiendo del tipo de framework que utilices shell
	            })
	            .error(function (data, status, headers, config) {
	                console.log("No se pudo actualizar");
	            });
	    }

	    $scope.eliminarEmpresa = function (index) {
	        $http.post("dbRegistroTUVEI.php?action=DeleteEmpresa", {
	                'Empresa_index': index
	            })
	            .success(function (data, status, headers, config) {
	                $scope.getEmpresas();
	                //$('#modalEmpresaEliminada').foundation('open'); //Abrir modal de empresa eliminara
	                //$scope.limpiar2(); //Limpar formularios de eliminado
	            })
	            .error(function (data, status, headers, config) {

	            });
	    };

	    /*Función para obtener libros*/
	    $scope.getEmpresas = function () {
	        $http.get("dbRegistroTUVEI.php?action=getEmpresas").success(function (data, status, headers, config) {
	            $scope.Empresas = data;
	            console.log("Consulta realizada")
	        })
	        .error(function(data, status, headers, config) {
	            console.log("consulta no realizada");
	        });
	    }

	}]); 