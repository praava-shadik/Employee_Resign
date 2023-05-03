<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employee";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}