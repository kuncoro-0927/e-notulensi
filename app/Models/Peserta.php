<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'data_peserta';
    protected $fillable = ['id','nama', 'nip','jabatan'];
    public $timestamps = true;

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    public function pemimpin()
    {
        return $this->hasMany(Sekretaris::class, 'pemimpin_rapat_id');
    }
}
