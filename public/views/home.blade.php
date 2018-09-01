@extends('layouts.app')
@section('content')
    <div class="container" ng-app="employeeApp" ng-controller= "mainController">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button class="btn btn-primary btn-xs pull-right" data-target="modalEditNew" ng-click="addEmployee()">Add Empleados</button>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Firstname</th>
                                <th scope="col">Secondname</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="(index,itememployee) in employee.employee">
                                <td>
                                    @{{ index+1 }}
                                </td>
                                <td>@{{ itememployee.firstName }}</td>
                                <td>@{{ itememployee.lastName }}</td>
                              
                                <td>
                                    <a class="btn" ng-click="editEmployee(itememployee.id)" role="button">
                                         <span class="fa fa-pencil-alt fa-2x"></span>
                                    </a>
                                    <a class="btn" ng-click="deleteEmployee(itememployee.id)"role="button">
                                         <span class="fa fa-trash-alt fa-2x"></span>
                                    </a>
                                    <a class="btn" ng-click="addScheduleEmployee(itememployee.id)" role="button">
                                        <span class="fas fa-calendar-alt fa-2x"></span>
                                    </a>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="modalEditNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@{{isCreate?'Registrar empleado':'Editar empleado'}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form ng-submit = "isCreate?submitEmployee():updateEmployee()">

                        <div class="alert alert-danger" ng-if="errors.length > 0">
                            <ul>
                                <li ng-repeat="error in errors">@{{error}}</li>
                            </ul>
                        </div>
                        
                        <div class="form-group">
                            <label for="cod_employee">Nro Identificación</label>
                            <input type="text" id="cod_employee" name="cod_employee" class="form-control" ng-model="employeeData.cod_employee"></input>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-16">
                                <label for="firstName">Nombre</label>
                                <input type="text" id="firstName" name="firstName " class="form-control" ng-model="employeeData.firstName"></input>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName">Apellido</label>
                                <input type="text" id="lastName" name="lastName" class="form-control" ng-model="employeeData.lastName"></input>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phoneNumber">Email</label>
                                <input type="email" id="email" name="email" class="form-control" ng-model="employeeData.email"></input>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phoneNumber">Celular</label>
                                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" ng-model="employeeData.phoneNumber"></input>
                            </div>
                        </div>
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Direccion</label>
                                <input type="text" id="address" name="address" class="form-control" ng-model="employeeData.address"></input>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="position">Cargo</label>
                                <input type="text" id="position" name="position" class="form-control" ng-model="employeeData.position"></input>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnEnviar" id="btnEnviar" value="Guardar">
                        </div>
                       
                      </form>  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!--End Modal 1-->

            <!-- Begin Modal Horario --->
            <div class="modal" id="modalEditNewSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitleSchedule" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitleSchedule">@{{isCreateSchedule?'Registrar horario':'Editar horario'}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            .<table class="table table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Dia</th> <th>Hora entrada</th><th>Hora salida</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Lunes</td>
                                    <td><select id="dayOne" ng-click="setEndHour('dayOne')" ng-model="dayOne" class="form-control">
                                        <option>7:00 am</option>
                                        <option>8:00 am</option>
                                        <option>9:00 am</option>
                                        <option>10:00 am</option>
                                        <option>11:00 am</option>
                                        <option>12:00 am</option>
                                        <option>08:00 pm</option>
                                    </select></select></td>
                                    <td><label for="dayOneEnd" ng-model="dayOneEnd">
                                        @{{dayOneEnd}}
                                    </label></td>
                                </tr>
                                <tr>
                                    <td>Martes</td>
                                    <td><select id="dayTwo" ng-click="setEndHour('dayTwo')" ng-model="dayTwo" class="form-control">
                                        <option>7:00 am</option>
                                        <option>8:00 am</option>
                                        <option>9:00 am</option>
                                        <option>10:00 am</option>
                                        <option>11:00 am</option>
                                        <option>12:00 am</option>
                                        <option>08:00 pm</option>
                                    </select></select></td>
                                    <td><label for="dayTwoEnd" ng-model="dayTwoEnd">
                                        @{{dayTwoEnd}}
                                    </label></td>
                                </tr>
                                <tr>
                                    <td>Miercoles</td>
                                    <td><select id="dayThree" ng-click="setEndHour('dayThree')" ng-model="dayThree" class="form-control">
                                        <option>7:00 am</option>
                                        <option>8:00 am</option>
                                        <option>9:00 am</option>
                                        <option>10:00 am</option>
                                        <option>11:00 am</option>
                                        <option>12:00 am</option>
                                        <option>08:00 pm</option>
                                    </select></select></td>
                                    <td><label for="dayThreeEnd" ng-model="dayThreeEnd">
                                        @{{dayThreeEnd}}
                                    </label></td>
                                </tr>
                                <tr>
                                    <td>Jueves</td>
                                     <td><select id="dayFour" ng-click="setEndHour('dayFour')" ng-model="dayFour" class="form-control">
                                        <option>7:00 am</option>
                                        <option>8:00 am</option>
                                        <option>9:00 am</option>
                                        <option>10:00 am</option>
                                        <option>11:00 am</option>
                                        <option>12:00 am</option>
                                        <option>08:00 pm</option>
                                        </select></td>
                                     <td><label for="dayFourEnd" ng-model="dayFourEnd">
                                         @{{dayFourEnd}}
                                     </label></td>
                                </tr>
                                <tr>
                                    <td>Viernes</td>
                                     <td><select id="dayFive" ng-click="setEndHour('dayFive')" ng-model="dayFive" class="form-control">
                                        <option>7:00 am</option>
                                        <option>8:00 am</option>
                                        <option>9:00 am</option>
                                        <option>10:00 am</option>
                                        <option>11:00 am</option>
                                        <option>12:00 am</option>
                                        <option>08:00 pm</option>
                                     </select></select></td>
                                     <td><label for="dayFiveEnd" ng-model="dayFiveEnd">
                                         @{{dayFiveEnd}}
                                     </label></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>               
                    </div>                   
                </div>
            </div>
            <!-- End Modal Horario --->
    </div>
@endsection