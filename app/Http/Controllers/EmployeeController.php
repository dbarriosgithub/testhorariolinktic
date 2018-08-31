<?php

namespace App\Http\Controllers;

use App\employees\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees  = Employee::all();
        return response()->json(['employee'=>$employees],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = request()->all();

        $data = request()->validate(
        [
            'cod_employee' =>'required',
            'firstName'=>'required',
            'lastName'=>'required',
            'phoneNumber'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'position'=>'required',
          ]
        );


        Employee::create([
            'firstName'=> $data['firstName'],
            'cod_employee'=>$data['cod_employee'],
            'lastName'=> $data['lastName'],
            'phoneNumber'=>$data['phoneNumber'],
            'email'=>$data['email'],
            'address'=>$data['address'],
            'position'=>$data['position'],
        ]);

        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json(['employee'=>$employee]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Employee $employee)
    {
        $data= request()->validate(
          [
            'cod_employee' =>'required',
            'firstName'=>'required',
            'lastName'=>'required',
            'phoneNumber'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'position'=>'required',
          ]
        );

        return response()->json(['data'=>$employee->update(request()->all())]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['succes'=>true]);
    }
}
