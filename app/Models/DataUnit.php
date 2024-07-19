<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUnit extends Model
{
    use HasFactory;
    protected $table = 'data_unit';
    protected $fillable = ['id','nama_unit'];
    public $timestamps = true;

   
}
