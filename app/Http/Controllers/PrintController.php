<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Presensi;
use App\Models\Sekretaris;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{
    public function print() 
    {
    return view('templateprint');
    }
    public function printnotula($id)
{
    $items = Sekretaris::findOrFail($id);
    $presensi = Presensi::where('notula_id', $id)->with('peserta')->get();
    $notula = Sekretaris::with('upload')->find($id);
    $units = User::where('role_id', 1)->get();
    $pemimpin = Sekretaris::with('peserta')->where('pemimpin_rapat_id', $id)->get();
    $totalPesertaHadir = $presensi->sum('jumlah_hadir');
    $jumlah = DB::table('buat_notula')
    ->select('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat', 'buat_notula.notulensi_rapat', DB::raw('SUM(data_presensi.jumlah_hadir) as total_hadir'))
        ->leftJoin('data_presensi', 'buat_notula.id', '=', 'data_presensi.notula_id','data_presensi.jumlah_hadir')
        ->groupBy('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat','buat_notula.notulensi_rapat')
        ->get();
        $data = Presensi::select('notula_id', DB::raw('SUM(jumlah_hadir) as jumlah_peserta'))
                ->groupBy('notula_id')
                ->get();
                $groupedData = $data->groupBy('notula_id');
                $totalPeserta = Presensi::where('notula_id', $id)
                ->sum('jumlah_hadir');

        $pemimpin = DB::table('buat_notula')
                ->join('data_peserta', 'buat_notula.pemimpin_rapat_id', '=', 'data_peserta.id')
                ->select('data_peserta.nama', 'data_peserta.nip', 'data_peserta.jabatan')
                ->where('buat_notula.id', $id)
                ->first();
                
    return view('templateprint', compact('totalPeserta','items','presensi','notula','units','pemimpin','totalPesertaHadir','jumlah','data','pemimpin'));
}

public function printpresensi($notula_id)
{
  
    $presensi = Presensi::with('peserta')->where('notula_id', $notula_id)->get();
    $jumlah = DB::table('buat_notula')
    ->select('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat', 'buat_notula.notulensi_rapat', DB::raw('SUM(data_presensi.jumlah_hadir) as total_hadir'))
        ->leftJoin('data_presensi', 'buat_notula.id', '=', 'data_presensi.notula_id','data_presensi.jumlah_hadir')
        ->groupBy('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat','buat_notula.notulensi_rapat')
        ->get();
    
        $data = Presensi::select('notula_id', DB::raw('COUNT(peserta_id) as jumlah_peserta'))
                ->groupBy('notula_id')
                ->get();
                $pemimpin = DB::table('buat_notula')
                ->join('data_peserta', 'buat_notula.pemimpin_rapat_id', '=', 'data_peserta.id')
                ->select('data_peserta.nama', 'data_peserta.nip', 'data_peserta.jabatan')
                ->where('buat_notula.id', $notula_id)
                ->first();
    return view('printpresensi', compact('presensi','jumlah','data','pemimpin'));
}



}
