angular.module('mainCtrl',[])
	.controller('mainController',function($scope,$http,Employee){
       
		$scope.employeeData = {};
		$scope.loading = true;
		$scope.errors = []; //variable para manejar los errores generados en las validaciones 

		
		//obtener o  listar todas  las empleados llamando al servicio get()
		//--------------------------------------------------------------
		Employee.get()
		 	  .success(function(data){
		 	  	$scope.employee = data;
		 	  	$scope.loading =  false;
		 	   }
		 	 )
		 	  .error(function(error){
		 	  	$scope.recordErrors(error);
		 	  });	

       //guardar una empleado
       //-----------------------------------------------------------
	    $scope.submitEmployee =  function(){
	    	$scope.loading = true;

	    	Employee.save($scope.employeeData)
	    		   .success(function(getData){
	    		   	Employee.get() // si es exitoso se actualiza el listado de empleados
	    		   		.success(function(getData){
	    		   			$scope.employee = getData;
	    		   	        $scope.loading = false;
	    		   	        $('#modalEditNew').modal('hide');
	    		   		});	
	    		   })
	    		   .error(function(error){
	    		   	 // en caso de error se registra
	    		   	  $scope.recordErrors(error);
	    		   });
	    };

	    //delete un empleado
	    //-------------------------------------------------
	    $scope.deleteEmployee =  function(id){
	    	$scope.loading =  true;
	    	Employee.destroy(id)
	    		  .success(function (data){
		    		  	Employee.get() // si es exitoso se actualiza el listado de empleados
		    		  	.success(function(getData){
		    		  		$scope.employee = getData;
		    		  	    $scope.loading = false;
		    		  	});
	    		  	
	    		  });	

	    };

	    $scope.addEmployee =  function(){
	    	$scope.errors = [];
	    	$scope.employeeData.firstName='' ;
	    	$('#modalEditNew').modal('show');
	    	$scope.isCreate=true;
	    };

	    $scope.editEmployee = function(id){
	    	$scope.errors = [];
	    	Employee.show(id)
	    	  .success(function(data){
	    	   $scope.employeeData = data.employee;
	    	   $scope.isCreate=false;
	    	  $('#modalEditNew').modal('show');
	    	});	  
	    };

	    $scope.updateEmployee = function (){
	    	$scope.loading = true;
	    	Employee.update($scope.employeeData)
	    		   .success(function(getData){
	    		   	Employee.get() // si es exitoso se actualiza el listado de empleados
	    		   		.success(function(getData){
	    		   			$scope.employee = getData;
	    		   	        $scope.loading = false;
   							$('#modalEditNew').modal('hide');
	    		   		});	
	    		   	  
	    		   })
	    		   .error(function(error){
	    		   	// en caso de error se registra
	    		   	$scope.recordErrors(error);
	    		   });
	    };

	    //función para manipular selects dependientes	
	    $scope.dropdownlinked =  function(model,foreign_key){

	    	eval(model).getByField(foreign_key,eval('$scope.employeeData.'+foreign_key))
	    		.success(function(data){
	    		   eval('$scope.options'+model+' = data.'+model.toLowerCase()+'s');
	    		});	
	    };

	    $scope.addScheduleEmployee = function(){
	    	$('#modalEditNew').modal('hide');
	    	$('#modalEditNewSchedule').modal('show');
	    	$scope.isCreateSchedule=true;
	    };

	    $scope.setEndHour= function(day){
           he =  eval("$scope."+day);
           
           // se establece la jornada AM/PM
           jr = he.split(" ");

          //se divide el tiempo en horas:minutos
           numtime  = jr[0].split(":");


          //Hora de salida sumando  las 8 horas
           hs =  (parseInt(numtime[0]) + parseInt(8));

          // si la hora de salida sobrepasa la hora 12  
           if(hs > parseInt(12))
           	 hs =  (parseInt(numtime[0]) + parseInt(8) )- parseInt(12);
         
           
           // si la hora de entrada es mayor a la de salida,sale en una jornada diferente  	
           if(parseInt(he) > hs){

           	if(jr[1]=="am") {
          	  jr[1] =  " pm";
            }
            else if(jr[1]=="pm")
            {
			   jr[1] =  " am";
            }

           }

           hs = hs + ":"+numtime[1] +jr[1];

         
          eval("$scope."+day+"End = hs");

	    };

	   $scope.recordErrors = function (error) {
         if(!error.exception){
        	angular.forEach(error.errors, function(value, key) {
 				 $scope.errors.push(value[0]);
			});
		 }
       };
	});	