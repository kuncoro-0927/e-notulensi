<?php

namespace App\Http\Controllers;

use App\Models\DataJabatan;
use App\Models\DataUnit;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Presensi;
use App\Models\Sekretaris;
use App\Models\User;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperadminController extends Controller
{
    //dashboard
    public function viewdashboard()
    {
        
        return view('superadmin.dashboard');
    }
  

    //sekretaris
    public function viewsekretaris($id)
    {
        
        $datas = User::findOrFail($id);
        return view('superadmin.peserta', compact('datas'));
    }



    public function tambahsekre(Request $request)
    {
        $user = new User([
            'name' => $request->input('name'),
            'nip' => $request->input('nip'),
            'unit' => $request->input('unit'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            
        ]);
        $user->role_id = 2;

        $user->save();


        // Lakukan aksi lain setelah membuat user

        return redirect('/superadmin/sekretaris')->with('success', 'User berhasil dibuat!');
    }

    public function savesekre()
     {
        $datas = User::where('role_id', 2)->get();
        $units = DataUnit::all();
        $sekre = User::where('role_id', 2)->get();
        
        return view('superadmin.sekretaris', compact('datas','units','sekre'));
     }

     public function destroy($id)
     {
         $user = User::find($id);
     
         if (!$user) {
             return redirect()->route('users.index')->with('error', 'User not found');
         }
     
         // Hanya hapus pengguna dengan role_id 2 (sekretaris)
         if ($user->role_id == 2) {
             $user->delete();
             return back()->with('success', 'Sekretaris deleted successfully');
         } else {
             return back()->with('error', 'You do not have permission to delete this user');
         }
        }

    // notulensi

    public function viewnotulensi()
    {
        
        return view('superadmin.notulensi');
    }

    public function joinnotulen()
    {
        $data = DB::table('buat_notula')
        ->join('data_unit', 'buat_notula.id', '=', 'data_unit.buat_notula_id')
        ->join('upload', 'data_unit.id', '=', 'upload.data_unit_id')
        ->select('buat_notula.*', 'tabel2.field AS field_tabel2', 'tabel3.field AS field_tabel3')
        ->get();

return view('view', compact('data'));
    }

    //peserta
    public function viewpeserta()
    {
        
        return view('superadmin.peserta');
    }

    public function tambahPeserta(Request $request)
{
    $request->validate([
        'nip' => 'required',
        'nama' => 'required',
        'jabatan' => 'required',
        ], [
         'nip.required' => 'Nip Wajib Diisi',
        'nama.required' => 'Nama Wajib Diisi',
        'jabatan.required' => 'Jabatan Rapat Wajib Diisi',
        ]);
 
        Peserta::create($request->all());

     return redirect('/superadmin/peserta')->with('success', 'Data telah berhasil disimpan.');
 }
 
 public function save()
     {
         
         $datas = Peserta::all();
         $jabatans = DataJabatan::all();
         return view('superadmin.peserta', compact('datas','jabatans'));
     }
    
   


    //jabatan
    public function viewjabatan()
    {
        
        return view('superadmin.datajabatan');
    }

    public function tambahJabatan(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            
            ], [
            'jabatan.required' => 'Nama Jabatan Wajib Diisi',
            ]);
     
            DataJabatan::create($request->all());
    
         return redirect('/superadmin/datajabatan')->with('success', 'Data telah berhasil disimpan.');
     }
    
     public function savejabatan()
         {
             
             $jabatans = DataJabatan::all();
             return view('superadmin.datajabatan', compact('jabatans'));
         }
    // unit
    public function viewunit()
    {
        
        return view('superadmin.dataunit');
    }

    public function tambahUnit(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required',
            
            ], [
            'nama_unit.required' => 'Pemimpin Rapat Wajib Diisi',
            ]);
     
            DataUnit::create($request->all());
    
         return redirect('/superadmin/dataunit')->with('success', 'Data telah berhasil disimpan.');
     }
    
     public function saveunit()
         {
             
             $units = DataUnit::all();
             return view('superadmin.dataunit', compact('units'));
         }

         //

    public function vieweditprofile()
    {
        
        return view('superadmin.edit_profile');
    }

    // edit peserta



    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            // tambahkan validasi lainnya
        ]);
        $datas = Peserta::findOrFail($id);
        $datas->update($request->all());
        // ...
    
        // Simpan perubahan
        $datas->save();

        return back()->with('success', 'Peserta berhasil diperbarui.');
    }
    
    //edit sekretaris

    public function editsekre(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'unit' =>'required',
            'email' => 'required',
            'password' => 'required|min:6'
            
            // tambahkan validasi lainnya
        ]);
        $sekre = User::findOrFail($id);
        $sekre->update([
            'name' => $request->input('name'),
            'nip' => $request->input('nip'),
            'unit' => $request->input('unit'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Hash password sesuai kebutuhan
            // Tambahkan field lainnya jika ada
        ]);
        // ...
    
        // Simpan perubahan
        $sekre->save();

        return back()->with('success', 'Peserta berhasil diperbarui.');
    }

    //edit unit
    public function updateunit(Request $request, $id)
    {
        $request->validate([
            'nama_unit' => 'required',
           
            // tambahkan validasi lainnya
        ]);
        $units = DataUnit::findOrFail($id);
        $units->update($request->all());
        // ...
    
        // Simpan perubahan
        $units->save();

        return back()->with('success', 'Peserta berhasil diperbarui.');
    }

    public function destroyunit(Request $request, $id)
     {
         
        $deleted = DB::table('data_unit')->where('id', $id)->delete();

    if ($deleted) {
        return back()->with('success', 'Unit deleted successfully');
    } else {
        return back()->with('error', 'Unit not found');
    }
   
}

//print notulensi

public function notulensi()
{
    $items = Sekretaris::all();

    return view('superadmin.notulensi', compact('items'));

}
}



