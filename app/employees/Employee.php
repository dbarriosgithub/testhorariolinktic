<?php

namespace App\employees;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table='employees';
    public $fillable = ['cod_employee','firstName','lastName','phoneNumber','email','address','position'];
}
