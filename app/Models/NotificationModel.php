<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory; 
    public $table ='notifications';
    public $primaryKey="nid";
    public $incrementing=true;
    public $keyType="int";
    public $timestamps = true;
}
