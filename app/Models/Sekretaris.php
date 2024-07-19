<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekretaris extends Model

{
    use HasFactory;
    protected $table = 'buat_notula';
    protected $fillable = ['id','undangan','topik_rapat','pemimpin_rapat','waktu_rapat','tempat_rapat','notulensi_rapat','jumlah_peserta','pemimpin_rapat_id'];
    public $timestamps = true;

    public function upload()
    {
        return $this->hasMany(Upload::class, 'notula_id');
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'pemimpin_rapat_id');
    }

    
}