<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Sekretaris;
use Illuminate\Support\Facades\Session;

class PresensiController extends Controller
{
    public function create($notula_id)
    {
        $notula = Sekretaris::find($notula_id);
        $pesertas = Peserta::all();

        // Ambil peserta yang sudah hadir pada notula tertentu
        $pesertaHadir = Presensi::where('notula_id', $notula_id)->pluck('peserta_id')->toArray();

        $notulas = Peserta::all();
        return view('sekretaris.dashboard', compact('notulas','presensi','pesertaHadir'));
    }
    

  //  public function store(Request $request, $id)
//{
  //  $request->validate([
    //    'notula_id' => 'required',

    //]);

   
    //$jumlah_hadir = count($request->input('hadir', []));

     //Simpan data presensi untuk setiap peserta yang hadir
  
      //Presensi::create([
        //    'notula_id' => $request->notula_id,
          //  'jumlah_hadir' => $jumlah_hadir, // Sesuai kebutuhan Anda
            
          //   ... other columns
        //]);
    
    //}
    // Validasi data input

    public function store(Request $request)
{
    $request->validate([
        'notula_id' => 'required|exists:buat_notula,id',
        'peserta_id' => 'required|array',
        'peserta_id.*' => 'exists:data_peserta,id',
    ]);

    // Ambil data dari input form
    $notulaId = $request->input('notula_id');
    $pesertaIds = $request->input('peserta_id', []);

    // Hapus presensi yang ada untuk rapat tertentu
    Presensi::where('notula_id', $notulaId)->delete();
    
    

    // Tambahkan presensi baru berdasarkan data input
    foreach ($pesertaIds as $pesertaId) {
        Presensi::create([
            'notula_id' => $notulaId,
            'peserta_id' => $pesertaId,
            'jumlah_hadir' => 1, // Set jumlah hadir ke 1
        ]);
    }
    session()->flash('success', 'Data presensi berhasil disimpan.');
    return back();
}

}


