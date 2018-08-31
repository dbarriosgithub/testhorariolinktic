angular.module('employeeService',[])
	   .factory('Employee',function($http){
	   	return{
	   		get:function(){
	   		  return $http.get('/api/employee/index');
	   		},
	   		save: function(employeeData){
	   		  return $http({
	   		  	 method:'POST',
	   		  	 url:'/api/employee/store',
	   		  	 headers:{'Content-Type':'application/x-www-form-urlencoded'},
	   		  	 data:$.param(employeeData)
	   		  });	
	   		},
	   		destroy:function(id){
	   			return $http.delete('/api/employee/destroy/'+id);
	   		},
	   		show:function(id){
	   		   return $http.get('/api/employee/show/'+id);
	   		},
	   		update: function(employeeData){
	   		  return $http({
	   		  	 method:'PUT',
	   		  	 url:'/api/employee/update/'+employeeData.id,
	   		  	 headers:{'Content-Type':'application/x-www-form-urlencoded'},
	   		  	 data:$.param(employeeData)
	   		  });	
	   		},

	   	}
});	