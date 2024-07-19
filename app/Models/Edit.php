<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edit extends Model

{
    use HasFactory;
    protected $table = 'buat_notula';
    protected $fillable = ['id','topik_rapat','pemimpin_rapat','waktu_rapat','tempat_rapat','notulensi_rapat'];
    public $timestamps = true;
}