<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model

{
    use HasFactory;
    public function notula()
    {
        return $this->belongsTo(Sekretaris::class);
    }
    protected $table = 'upload';
    protected $fillable = ['undangan', 'presensi','dokumentasi','notula_id'];
    public $timestamps = true;

    public function getDokumentasiArrayAttribute()
{
    return explode(',', $this->attributes['dokumentasi']);
}
public function getPresensiArrayAttribute()
{
    return explode(',', $this->attributes['presensi']);
}

public function getUndanganArrayAttribute()
{
    return explode(',', $this->attributes['undangan']);
}
}