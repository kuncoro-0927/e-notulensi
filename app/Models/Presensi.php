<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'data_presensi';
    protected $fillable = ['id','notula_id','jumlah_hadir','peserta_id'];
    public $timestamps = true;

    public function notulas()
    {
        return $this->belongsTo(Sekretaris::class);
    }
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id','id');
    }
}
