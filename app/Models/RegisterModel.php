<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterModel extends Model
{
    use HasFactory; 
    public $table ='students';
    public $primaryKey="id";
    public $incrementing=true;
    public $keyType="int";
    public $timestamps = true;
}
