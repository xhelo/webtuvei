
	var app = angular.module('myApp', []);
	app.controller('myCtrl', ['$scope','$http', function ($scope, $http, $modal){

		//Lista de empresas
	    $scope.listaUnidades = [];
	    $scope.Unidades = [];
	    $scope.Conductores = [];

	    $scope.idListaUnidad = "";
	    $scope.fecha = "25";
	    
	    $scope.idUnidad = "";
	    $scope.economico = "";
	    $scope.idConductor = "";
	    $scope.nombre = "";
	    $scope.estado = "";
	    $scope.nota = "";

	    $scope.idUnidadEliminar = "";

	    $scope.incrementarContadorIndice = function(){
	    	$scope.contadorIndice = $scope.contadorIndice + 1;
	    	console.log($scope.contadorIndice);
	    }

	    $scope.incrementarContadorModificado = function(){
	    	$scope.contadorModificado = $scope.contadorModificado + 1;
	    	console.log($scope.contadorModificado);
	    }

	    $scope.limpiarDatos = function(){
		    $scope.idListaUnidad = "";
		    $scope.fecha = "";
		    
		    $scope.idUnidad = "";
		    $scope.economico = "";
		    $scope.idConductor = "";
		    $scope.nombre = "";
		    $scope.estado = "";
		    $scope.nota = "";

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
	    $scope.datosListaUnidad = function (idUnidad,economico,idConductor,nombre,estado, nota){
	    	$scope.idUnidad = idUnidad;
		    $scope.economico = economico;
		    $scope.idConductor = idConductor;
		    $scope.nombre = nombre;
		    $scope.estado = estado;
		    $scope.nota = nota;
	    }

	    $scope.abrirModalModificar = function(){
	    	$("#modalActualizar").modal(); //Abrir modal
	    }

	    $scope.actualizarListaUnidad = function(){
	    	console.log("LLegó a modidicar");
	    	$http.post("dbListaUnidades.php?action=ActualizarListaUnidad", {
	                'fecha': $scope.fecha,
	                'idUnidad': $scope.idUnidad,
	                
	                'economico': $scope.economico,
	                'idConductor': $scope.idConductor,
	                'nombre': $scope.nombre,
	                'estado': $scope.estado,
	                'nota': $scope.nota,
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
	    $scope.getListaUnidades = function () {
	    	console.log("Llamó a lista unidades");
	        $http.get("dbListaUnidades.php?action=getListaUnidades").success(function (data, status, headers, config) {
	            $scope.listaUnidades = data;
	            console.log("Lista de unidades consultados");
	            console.log(data);
	        })
	        .error(function(data, status, headers, config) {
	            console.log("consulta de unidades no realizada");
	        });
	    }

	    $scope.getUnidades = function () {
	    	console.log("Llamó a unidades");
	        $http.get("dbListaUnidades.php?action=getUnidades").success(function (data, status, headers, config) {
	            $scope.Unidades = data;
	            console.log("Unidades consultados");
	            console.log(data);
	        })
	        .error(function(data, status, headers, config) {
	            console.log("consulta de unidades no realizada");
	        });
	    }

	    /*Función para obtener conductores*/
	    $scope.getConductores = function () {
	        $http.get("dbListaUnidades.php?action=getConductores").success(function (data, status, headers, config) {
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

	    $scope.registrarListaUnidades = function(){
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