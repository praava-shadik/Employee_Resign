<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResign extends Model
{
    protected $table = "employee_resign";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
    // protected $fillable = ['employee_id', 'employee_access_tool_id', 'had_access', 'access_removed', 'remarks'];
}
