<?php

use App\Http\Controllers\BuatNotulaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\EditNotulaController;
use App\Http\Controllers\ForgotPWController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PrintController;
use App\Models\Presensi;
use App\Models\Sekretaris;
use App\Models\Superadmin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//-----ROUTE SEKRETARIS------

//Route Login
//Route::middleware(['guest'])->group(function() {
  Route::group(['middleware' => 'checkRole:2'], function () {
  Route::get('/sekretaris/dashboard/{id}', [SekretarisController::class, 'viewdashboard'])->name('sekretaris.dashboard');
});

Route::group(['middleware' => 'checkRole:1'], function () {
Route::get('/superadmin/dashboard/{id}', [SuperadminController::class, 'viewdashboard'])->name('superadmin.dashboard');
  // Tambahkan rute lain untuk role superadmin
});



Route::get('/login', [LoginController::class, 'viewlogin']);
Route::post('/login', [LoginController::class, 'login'])->name('login.dashboard');
//});
//Route::get('/home', function () {
  //  return redirect('/sekretaris/dashboard');
//});

Route::get('/logout', [LoginController::class, 'logout']);


//Route Dashboard
Route::get('/sekretaris/dashboard', [SekretarisController::class, 'viewdashboard'])->name('dashboard');
Route::get('/sekretaris/dashboard', [SekretarisController::class, 'LihatDashboard']);

// Route Profile
Route::get('/sekretaris/profile', [SekretarisController::class, 'viewprofile']);

//Route Upload
Route::get('/sekretaris/upload', [SekretarisController::class, 'viewupload']);
Route::post('/sekretsris/{id}/upload', [SekretarisController::class, 'unggah'])->name('upload.file');

// routes/web.php

Route::get('/sekretaris/dashboard', [SekretarisController::class, 'save'])->name('dashboard');
Route::get('sekretaris/upload/{id}', [SekretarisController::class,'showUploadForm'])->name('upload.form');
Route::post('sekretaris/upload', [SekretarisController::class,'uploadFiles'])->name('upload.file');



//Route Buat Notula
Route::get('/sekretaris/buat_notula', [SekretarisController::class, 'viewnotula'])->name('sekretaris.buat_notula');
Route::post('/sekretaris/buat_notula', [SekretarisController::class, 'tambahData'])->name('sekretaris.buat_notula');
Route::get('/sekretaris/dashboard/{id}', [SekretarisController::class, 'save'])->name('sekretaris.save');
Route::get('/sekretaris/buat_notula', [SekretarisController::class, 'create'])->name('notula.create');



//Route Edit Notula
Route::get('/sekretaris/edit_notula', [SekretarisController::class, 'vieweditnotula'])->name('sekretaris.index');
Route::get('/sekretaris/{id}/edit_notula', [SekretarisController::class, 'edit'])->name('sekretaris.edit_notula');
Route::put('/sekretaris/{id}/edit_notula', [SekretarisController::class, 'update'])->name('sekretaris.update');

//Route Print
Route::get('/sekretaris/{id}/dashboard', [SekretarisController::class, 'print'])->name('download.file');
//Route::get('/download-files/{id}', 'YourController@downloadFiles');
// routes/web.php

Route::get('/templateprint', [PrintController::class, 'print']);
Route::get('/sekretaris/detail/{id}', [SekretarisController::class,'downloadFiles'])->name('notula.downloadFiles');
Route::get('/templateprint/{id}', [PrintController::class,'printnotula'])->name('notula.print');
//print presensi
Route::get('/printpresensi/{notula_id}', [PrintController::class, 'printpresensi'])->name('print.presensi');
// routes/web.php


// Menampilkan tampilan presensi
Route::get('/sekretaris/dashboard/{notulaId}', [PresensiController::class, 'show'])->name('presences.show');

// Menyimpan data presensi
Route::post('/sekretaris/dashboard', [PresensiController::class, 'store'])->name('presensi.store');



//Route Detail
Route::get('/sekretaris/detail', [SekretarisController::class, 'viewdetail']);
Route::get('sekretaris/detail/{id}', [SekretarisController::class,'showdetail'])->name('detail.rapat');
//Route::get('/sekretaris/detail', [SekretarisController::class, 'details'])->name('sekretaris.save');

//presensi
Route::get('/sekretaris/dashboard/{notula_id}', [PresensiController::class, 'create'])->name('presensi.create');
//Route::post('/sekretaris/dashboard', [PresensiController::class, 'store'])->name('presensi.store');
Route::get('sekretaris/{id}/dashboard', [PresensiController::class,'save'])->name('presensi.form');
Route::post('/sekretaris/dashboard/{id}', [PresensiController::class, 'store'])->name('dashboard.store-presensi');
//Route::get('/sekretaris/dashboard', [PresensiController::class, 'tampilkanData'])->name('tampilkan.presensi');

Route::get('/reset_password', [LoginController::class, 'viewreset']);

Route::get('/forgotpw', [LoginController::class, 'viewforgot']);




//-------SUPERADMIN-----------
//Route dashboard
Route::get('/superadmin/dashboard', [SuperadminController::class, 'viewdashboard'])->name('dashboard');

//Route Peserta
Route::get('/superadmin/peserta', [SuperadminController::class, 'viewpeserta']);
Route::post('/superadmin/peserta', [SuperadminController::class, 'tambahPeserta'])->name('superadmin.tambahpeserta');
Route::get('/superadmin/peserta', [SuperadminController::class, 'save'])->name('superadmin.save');

//edit peserta
//Route::get('/superadmin/{id}/peserta', [SuperadminController::class, 'save'])->name('superadmin.index');
Route::put('/superadmin/{id}/peserta', [SuperadminController::class, 'update'])->name('update-data');

//edit sekretaris
Route::get('/superadmin/{id}/sekretaris', [SuperadminController::class, 'savesekre'])->name('superadmin.index');
Route::put('/superadmin/{id}/sekretaris', [SuperadminController::class, 'editsekre'])->name('update-datasekre');

//Route Sekretaris
Route::get('/superadmin/sekretaris', [SuperadminController::class, 'viewsekretaris']);
Route::post('/superadmin/sekretaris', [SuperadminController::class, 'tambahsekre'])->name('superadmin.tambahsekre');
Route::get('/superadmin/sekretaris', [SuperadminController::class, 'savesekre'])->name('superadmin.save');
Route::delete('/superadmin/sekretaris/{id}', [SuperadminController::class, 'destroy'])->name('users.destroy');
//Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');




//Route data jabatan
Route::get('/superadmin/datajabatan', [SuperadminController::class, 'viewjabatan']);
Route::get('/superadmin/datajabatan', [SuperadminController::class, 'savejabatan']);
Route::post('/superadmin/datajabatan', [SuperadminController::class, 'tambahJabatan'])->name('superadmin.tambahJabatan');

//Route data unit
Route::get('/superadmin/dataunit', [SuperadminController::class, 'viewunit']);
Route::get('/superadmin/dataunit', [SuperadminController::class, 'saveunit']);
Route::post('/superadmin/dataunit', [SuperadminController::class, 'tambahUnit'])->name('superadmin.tambahUnit');

//edit delete unit
Route::put('/superadmin/{id}/dataunit', [SuperadminController::class, 'updateunit'])->name('update-dataunit');
Route::delete('/superadmin/{id}/dataunit', [SuperadminController::class, 'destroyunit'])->name('unit.destroy');
//Route Notulensi
Route::get('/superadmin/notulensi', [SuperadminController::class, 'viewnotulensi']);
Route::get('/superadmin/notulensi', [SuperadminController::class, 'notulensi'])->name('notulensi.print');

//Route edit profile
Route::get('/superadmin/edit_profile', [SuperadminController::class, 'vieweditprofile']);