
	var app = angular.module('myApp', []); 
	app.controller('myCtrl', ['$scope','$http', function ($scope, $http, $modal){

		//Lista de empresas
	    $scope.Unidades = [];

	    $scope.idUnidad = "";
	    $scope.matricula = "";
	    $scope.economico = "";
	    $scope.turno = "";
	    $scope.duenio = "";
	    $scope.tipo = "";
	    $scope.modelo = "";

	    $scope.idUnidadEliminar = "";

	    $scope.limpiarDatos = function(){
		    $scope.idUnidad = "";
		    $scope.matricula = "";
		    $scope.economico = "";
		    $scope.turno = "";
		    $scope.duenio = "";
		    $scope.tipo = "";
		    $scope.modelo = "";

		    $scope.idUnidadEliminar = "";
	    }

	    /*Eliminar conductor*/
	    $scope.cambiarIdUnidad = function(index){
	    	$scope.idUnidadEliminar = index;
	    }

	    $scope.abrirModalEliminar = function(){
	    	$("#modalEliminar").modal(); //Abrir modal
	    }

	    $scope.eliminarUnidad = function (index){
	    	$http.post("dbUnidades.php?action=DeleteUnidad", {
	                'Unidad_index': index
	            })
	            .success(function (data, status, headers, config) {
	                $('#modalEliminar').modal('hide');
	                $('#modalUnidadEliminado').modal(); //Abrir modal de conductor eliminara
	                $scope.getUnidades();
	                $scope.limpiarDatos(); //Limpar formularios de eliminado
	            })
	            .error(function (data, status, headers, config) {

	            });
	    }
	    /*Modificar conductor*/
	    $scope.datosUnidad = function (idUnidad,matricula,economico,turno,duenio,tipo, modelo){
	    	$scope.idUnidad = idUnidad;
		    $scope.matricula = matricula;
		    $scope.economico = economico;
		    $scope.turno = turno;
		    $scope.duenio = duenio;
		    $scope.tipo = tipo;
		    $scope.modelo = modelo;	
	    }

	    $scope.abrirModalModificar = function(){
	    	$("#modalActualizar").modal(); //Abrir modal
	    }

	    $scope.actualizarUnidad = function(){
	    	$http.post("dbUnidades.php?action=ActualizarUnidad", {
	                'idUnidad': $scope.idUnidad,
	                
	                'matricula': $scope.matricula,
	                'economico': $scope.economico,
	                'turno': $scope.turno,
	                'duenio': $scope.duenio,
	                'tipo': $scope.tipo,
	                'modelo': $scope.modelo,
	            })
	            .success(function (data, status, headers, config) {
	                $('#modalActualizar').modal('hide'); //Cerrar modal de Bootstrap
    				$('#modalActualizarExitoso').modal();
    				$scope.getUnidades();
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
	    $scope.getUnidades = function () {
	    	console.log("Llamó a unidades");
	        $http.get("dbUnidades.php?action=getUnidades").success(function (data, status, headers, config) {
	            $scope.Unidades = data;
	            console.log("Unidades consultados");
	            console.log(data);
	        })
	        .error(function(data, status, headers, config) {
	            console.log("consulta de unidades no realizada");
	        });
	    }

	    /*Enviar datos al servidor*/
	     /*1.- Confirmar datos*/
	    $scope.confirmarEnvio = function(){
    		$('#modalAgregar').modal('hide'); //Cerrar modal de Bootstrap
    		
    		console.log("Llamó a modal");
    		$("#modalConfirmarRegistro").modal(); //Abrir modal
	    }

	    $scope.registrarUnidad = function(){
	    	console.log("Se llamó a la función registrarUnidad");
	        $http.post('dbUnidades.php?action=AgregarUnidad', {
	                'matricula': $scope.matricula,
	                'economico': $scope.economico,
	                'turno': $scope.turno,
	                'duenio': $scope.duenio,
	                'tipo': $scope.tipo,
	                'modelo': $scope.modelo,
	            })
	            .success(function (data, status, headers, config) {
	                //Abrimos modal de registro exitoso
	                $('#modalConfirmarRegistro').modal('hide'); //Cerrar modal de Bootstrap
		    		$("#modalRegistradoExito").modal(); //Abrir modal
		    		$scope.getUnidades();
	            })
	            .error(function (data, status, headers, config) {

	            });
	    }

	}]); 