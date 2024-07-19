<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekretaris;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SekretarisController extends Controller
{
    //LOGIN
    public function viewlogin() 
    {
    return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email'=> 'required',
            'password'=>'required',
        ], [
            'email.required'=>'Email Wajib diisi',
            'password.required'=>'Password Wajib diisi'
        ]);

        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ]; 
        if(Auth::attempt($infologin)) {

            if(Auth::user()->role=='pengguna'){
                return redirect('/pengguna/dashboard');
            } elseif (Auth::user()->role=='sekretaris'){
                return redirect('/sekretaris/dashboard');
            } elseif(Auth::user()->role=='superadmin'){
                return redirect('/superadmin/dashboard');
            }
            
            } else {
            return redirect('/login')->withErrors('Username dan password tidak sesuai')->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('');
    }

    // FORGOT PW
    public function viewforgot() 
    {
    return view('sekretaris.forgotpw');
    }

    // RESET PASSWORD

    public function viewreset()
    {
        return view('sekretaris.reset_password');
    }

    // DASHBOARD
    public function viewdashboard()
    {
        
        return view('sekretaris.dashboard');
    }
  

    // BUAT NOTULA

    public function viewnotula()
    {
        return view('sekretaris.buat_notula');
    }
    public function create()
    {
        // Ambil daftar peserta untuk opsi pemimpin rapat
        $dataPesertaList = Peserta::all();

        return view('sekretaris.buat_notula', ['dataPesertaList' => $dataPesertaList]);
    }

    // Metode untuk menyimpan data notula
   

    public function tambahData(Request $request)
    {
$request->validate([
       'topik_rapat' => 'required',
       
       'waktu_rapat' => 'required',
       'tempat_rapat' => 'required',
       'notulensi_rapat' => 'required',
       'undangan' => 'required',
       'pemimpin_rapat_id' => 'required|exists:data_peserta,id',
       ], [
        'topik_rapat.required' => 'Topik Rapat Wajib Diisi',

       'waktu_rapat.required' => 'Waktu Rapat Wajib Diisi',
       'tempat_rapat.required' => 'Tempat Rapat Wajib Diisi',
       'notulensi_rapat.required' => 'Notulensi Rapat Wajib Diisi',
       ]);

       $dataPeserta = Peserta::find($request->input('pemimpin_rapat_id'));

    $notula = new Sekretaris();
    $notula->topik_rapat = $request->input('topik_rapat');
    $notula-> waktu_rapat = $request->input('waktu_rapat');
    $notula->tempat_rapat = $request->input('tempat_rapat');
    $notula->notulensi_rapat = $request->input('notulensi_rapat');
    $notula->undangan = $request->input('undangan');
    $notula->pemimpin_rapat = $dataPeserta->nama; // Atau sesuai dengan kolom yang sesuai di model DataPeserta
    $notula->pemimpin_rapat_id = $request->input('pemimpin_rapat_id');
    // ...Tambahkan kolom lainnya sesuai kebutuhan

    $notula->save();

      // Sekretaris::create($request->all());
     // Sekretaris::create([
       // 'topik_rapat' => $request->input('topik_rapat'),
        //'pemimpin_rapat' => $request->input('pemimpin_rapat'),
        //'waktu_rapat' => $request->input('waktu_rapat'),
        //'tempat_rapat' => $request->input('tempat_rapat'),
        //'notulensi_rapat' => $request->input('notulensi_rapat'),
        //'undangan' => $request->input('undangan'),
        //'pemimpin_rapat_id' => $request->input('pemimpin_rapat_id'),
        
        // ...Tambahkan kolom lainnya sesuai dengan kebutuhan
    //]);
    

    return back()->with('success', 'Data telah berhasil disimpan.');
}

public function presensi()
{
    $presensiData = Presensi::with('notula_id', 'peserta')->get();
        $pesertaData = Peserta::all();

        return view('presensi.index', compact('presensiData', 'pesertaData'));
    }



public function storePresensi(Request $request)
{
    $hadir = $request->input('peserta_id', []);

    // Simpan presensi kehadiran peserta di tabel buat_notula
    $notula = Sekretaris::first(); // Ambil notula terakhir (gantilah dengan metode lain jika diperlukan)
    
    foreach ($hadir as $pesertaId) {
        $notula->update(['jumlah_hadir' => $pesertaId]);
    }

    return back()->with('success', 'Presensi berhasil disimpan.');
}

public function save()
    {
        
        $items = Sekretaris::all();
 
        $datas = Peserta::all();
        $jumlah = DB::table('buat_notula')
        ->select('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat', 'buat_notula.notulensi_rapat', DB::raw('SUM(data_presensi.jumlah_hadir) as total_hadir'))
            ->leftJoin('data_presensi', 'buat_notula.id', '=', 'data_presensi.notula_id','data_presensi.jumlah_hadir')
            ->groupBy('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat','buat_notula.notulensi_rapat')
            ->get();
       // $jumlah = Presensi::where('notula_id', $id)->get();
       // $dataPresensi = Presensi::where('notula_id', $id)->get();
       
       
        return view('sekretaris.dashboard', compact('items', 'datas','jumlah'));
    }


  //  public function savepeserta()
    //{
        
      //  $datas = Peserta::all();
        //return view('sekretaris.dashboard', compact('datas'));
    //}

    // PROFILE

    public function viewprofile() 
    {
    return view('sekretaris.profile');
    }

    // EDIT NOTULA

    public function vieweditnotula() 
    {
    
        return view('sekretaris.edit_notula');
    }

    public function edit($id)
{
    $items = Sekretaris::findOrFail($id);
    $dataPesertaList = Peserta::all();


    return view('sekretaris.edit_notula', compact('items','dataPesertaList'));
}

    public function update(Request $request, $id)
{
    // Validasi input jika diperlukan
    $this->validate($request, [
    
        'topik_rapat' => 'required',
     'undangan'=> 'required',
       'waktu_rapat' => 'required',
       'tempat_rapat' => 'required',
       'notulensi_rapat' => 'required',
       'pemimpin_rapat_id' => 'required|exists:data_peserta,id',
        // ...
    ]);

    $dataPeserta = Peserta::find($request->input('pemimpin_rapat_id'));

    
   
    // ...Tambahkan kolom lainnya sesuai kebutuhan

   
    // Lakukan pembaruan data
    $items = Sekretaris::findOrFail($id);
    $items->update($request->all());
    $items->topik_rapat = $request->input('topik_rapat');
    $items-> waktu_rapat = $request->input('waktu_rapat');
    $items->tempat_rapat = $request->input('tempat_rapat');
    $items->notulensi_rapat = $request->input('notulensi_rapat');
    $items->undangan = $request->input('undangan');
    $items->pemimpin_rapat = $dataPeserta->nama; // Atau sesuai dengan kolom yang sesuai di model DataPeserta
    $items->pemimpin_rapat_id = $request->input('pemimpin_rapat_id');
    // ...

    // Simpan perubahan
    $items->save();

    // Redirect atau kembalikan respon yang sesuai
    return back()->with('success', 'Data berhasil diperbarui');
}

// UPLOAD 

public function viewupload()
    {
        return view('sekretaris.upload');
    }

    public function showUploadForm($id)
    {
        $items = Sekretaris::findOrFail($id);
        return view('sekretaris.upload', compact('items'));
    }

    public function uploadFiles(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'notula_id' => 'required|exists:buat_notula,id',
        ]);

        // Simpan file undangan ke direktori tertentu
    
        $undanganPaths = [];
        $presensiPaths = [];
        $dokumentasiPaths = [];
    
        // Simpan file undangan
        if ($request->hasFile('undangan')) {
            foreach ($request->file('undangan') as $file) {
                $undanganPaths[] = $file->storeAs('upload', $file->getClientOriginalName());
            }
        }
    
        // Simpan file presensi
        if ($request->hasFile('presensi')) {
            foreach ($request->file('presensi') as $file) {
                $presensiPaths[] = $file->storeAs('upload', $file->getClientOriginalName());
            }
        }
    
        // Simpan file dokumentasi
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $dokumentasiPaths[] = $file->storeAs('upload', $file->getClientOriginalName());
            }
        }
        $undanganPaths = implode(',', $undanganPaths);
        $presensiPaths = implode(',', $presensiPaths);
        $dokumentasiPaths = implode(',', $dokumentasiPaths);
        // Simpan path file ke database bersama dengan notula_id
        Upload::create([
            'notula_id' => $request->input('notula_id'),
            'undangan' => $undanganPaths,
        'presensi' => $presensiPaths,
        'dokumentasi' => $dokumentasiPaths,

            // tambahkan kolom-kolom lainnya sesuai kebutuhan
        ]);
        return back()->with('success', 'Data berhasil diperbarui');
    }

public function download($id)
{
    $file = Upload::findOrFail($id);

    // Ambil path file dari database
    $filePath = storage_path("app/{$file->file_path}");

    // Lakukan logika lain jika diperlukan, misalnya: verifikasi hak akses

    // Return sebagai response untuk di-download
    return response()->download($filePath, $file->original_filename);
}

// DETAIL NOTULA

public function viewdetail()
    {
        
        return view('sekretaris.detail');
    }


    public function showdetail($id)
    {
        $items = Sekretaris::findOrFail($id);
     
    $presensi = Presensi::where('notula_id', $id)->get();
   
    
        // Menggunakan with('uploads') untuk eager loading relasi uploads
        $notula = Sekretaris::with('upload')->find($id);
        $jumlah = DB::table('buat_notula')
        ->select('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat', 'buat_notula.notulensi_rapat', DB::raw('SUM(data_presensi.jumlah_hadir) as total_hadir'))
            ->leftJoin('data_presensi', 'buat_notula.id', '=', 'data_presensi.notula_id','data_presensi.jumlah_hadir')
            ->groupBy('buat_notula.id','buat_notula.undangan', 'buat_notula.topik_rapat', 'buat_notula.pemimpin_rapat','buat_notula.tempat_rapat', 'buat_notula.waktu_rapat','buat_notula.notulensi_rapat')
            ->get();
            $totalPeserta = Presensi::where('notula_id', $id)
            ->sum('jumlah_hadir');
       
    
        return view('sekretaris.detail', compact('items','presensi','notula','jumlah','totalPeserta'));
        
    }

   

    // PRINT
   
}


