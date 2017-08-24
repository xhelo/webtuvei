
	var app = angular.module('myApp', []); 
	app.controller('myCtrl', ['$scope','$http', function ($scope, $http, $modal){

		//Lista de empresas
	    $scope.Conductores = [];

	    $scope.idConductor = "";
	    $scope.nombre = "";
	    $scope.licenciaConducir = "";
	    $scope.curp = "";
	    $scope.estadoCivil = "";
	    $scope.sexo = "";

	    $scope.idConductorEliminar = "";

	    $scope.limpiarDatos = function(){
	    	$scope.idConductor = "";
	    	$scope.nombre = "";
	    	$scope.licenciaConducir = "";
		    $scope.curp = "";
		    $scope.estadoCivil = "";
		    $scope.sexo = "";
	    }

	    /*Eliminar conductor*/
	    $scope.cambiarIdConductor = function(index){
	    	$scope.idConductorEliminar = index;
	    }

	    $scope.abrirModalEliminar = function(){
	    	$("#modalEliminar").modal(); //Abrir modal
	    }

	    $scope.eliminarConductor = function (index){
	    	$http.post("dbConductores.php?action=DeleteConductor", {
	                'Conductor_index': index
	            })
	            .success(function (data, status, headers, config) {
	                $('#modalEliminar').modal('hide');
	                $('#modalConductorEliminado').modal(); //Abrir modal de conductor eliminara
	                $scope.getConductores();
	                $scope.limpiarDatos(); //Limpar formularios de eliminado
	            })
	            .error(function (data, status, headers, config) {

	            });
	    }
	    /*Modificar conductor*/
	    $scope.datosConductor = function (idConductor,nombre,licenciaConducir,curp,estadoCivil,sexo){
	    	$scope.idConductor = idConductor;
	    	$scope.nombre = nombre;
	    	$scope.licenciaConducir = licenciaConducir;
		    $scope.curp = curp;
		    $scope.estadoCivil = estadoCivil;
		    $scope.sexo = sexo;	
	    }
	    
	    $scope.abrirModalModificar = function(){
	    	$("#modalActualizar").modal(); //Abrir modal
	    }

	    $scope.actualizarConductor = function(){
	    	$http.post("dbConductores.php?action=ActualizarConductor", {
	                'idConductor': $scope.idConductor,
	                
	                'nombre': $scope.nombre,
	                'licenciaConducir': $scope.licenciaConducir,
	                'curp': $scope.curp,
	                'estadoCivil': $scope.estadoCivil,
	                'sexo': $scope.sexo,
	            })
	            .success(function (data, status, headers, config) {
	                $('#modalActualizar').modal('hide'); //Cerrar modal de Bootstrap
    				$('#modalActualizarExitoso').modal();
    				$scope.getConductores();
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


	    /*Función para obtener conductores*/
	    $scope.getConductores = function () {
	        $http.get("dbConductores.php?action=getConductores").success(function (data, status, headers, config) {
	            $scope.Conductores = data;
	            console.log("Conductores consultados")
	        })
	        .error(function(data, status, headers, config) {
	            console.log("consulta de conductores no realizada");
	        });
	    }

	    /*Enviar datos al servidor*/
	     /*1.- Confirmar datos*/
	    $scope.confirmarEnvio = function(){
    		$('#modalAgregar').modal('hide'); //Cerrar modal de Bootstrap
    		
    		console.log("Llamó a modal");
    		$("#modalConfirmarRegistro").modal(); //Abrir modal
	    }

	    $scope.registrarConductor = function(){
	    	console.log("Se llamó a la función registrarConductor");
	        $http.post('dbConductores.php?action=AgregarConductor', {
	                'nombre': $scope.nombre,
	                'licenciaConducir': $scope.licenciaConducir,
	                'curp': $scope.curp,
	                'estadoCivil': $scope.estadoCivil,
	                'sexo': $scope.sexo,
	            })
	            .success(function (data, status, headers, config) {
	                //Abrimos modal de registro exitoso
	                $('#modalConfirmarRegistro').modal('hide'); //Cerrar modal de Bootstrap
		    		$("#modalRegistradoExito").modal(); //Abrir modal
		    		$scope.getConductores();
	            })
	            .error(function (data, status, headers, config) {

	            });
	    }

	}]); 