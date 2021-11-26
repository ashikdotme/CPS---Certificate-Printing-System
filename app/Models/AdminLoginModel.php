<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLoginModel extends Model
{
    use HasFactory;
    public $table ='admin_table';
    public $primaryKey="id";
    public $incrementing=true;
    public $keyType="int";
    public $timestamps = true;
}
