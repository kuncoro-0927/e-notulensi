<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buat Notula</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <style>
      .sidebar {
        height: 100vh;
        background-color: #242564;
        width: 250px;
        position: fixed;
        transition: transform 0.3s;
        transform: translateX(0); /* Awalnya sidebar terbuka */
        box-shadow: 5px 0 5px rgba(0, 0, 0, 0.2);
        z-index: 2; /* Sidebar berada di atas main */
      }

      .sidebar-hidden {
        transform: translateX(-200px); /* Sisakan ruang untuk tombol toggle */
      }

      .logo-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
      }

      .logo-container img {
        max-width: 100px;
        height: auto;
      }

      .main {
        margin-left: 250px; /* Atur margin kiri untuk memberi ruang pada sidebar */
        padding: 20px;
        z-index: 1; /* Main berada di bawah sidebar */
        position: relative;
        width: calc(100% - 250px); /* Lebar "main" adalah 100% - lebar sidebar */
      }

      .toggle-button {
        position: absolute;
        top: 10px; /* Atur jarak dari atas */
        right: 10px; /* Atur jarak dari kanan */
        font-size: 30px;
        width: 40px;
        height: 40px;
        background-color: #242564;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        z-index: 3; /* Tombol toggle berada di atas semua */
        cursor: pointer; /* Mengubah kursor menjadi tangan saat diarahkan ke tombol toggle */
        display: flex;
        align-items: center;
        justify-content: center;
      }

      /* Menyembunyikan garis bawah pada tautan di dalam elemen dengan kelas "toggle-button" */
      .toggle-button a {
        text-decoration: none;
      }
      /* Garis bawah untuk "Vokasi UB" */
      .line {
        width: 100%;
        border-bottom: 1px solid #fff; /* Warna dan ketebalan garis dapat disesuaikan */
        margin: 10px 0;
      }
    </style>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
          <div class="d-flex flex-column align-items-center position-sticky">
            <!-- Logo -->
            <div class="logo-container">
              <img src="{{ asset('img/SIANO_logo.png') }}" alt="SIANO Logo" />
              <!-- Toggle button -->
              <div id="sidebar-toggle" class="toggle-button mt-3">≡</div>
            </div>
            <div class="line"></div>
            <!-- Garis bawah baru -->

            <ul class="nav flex-column mt-4">
              <!-- mt-4 untuk memberi margin atas -->
              <li class="nav-item">
                <a id="dashboard" class="nav-link active text-white" href="{{ url('/sekretaris/dashboard') }}" > <i class="fas fa-home mx-2"></i> Dashboard </a>
              </li>
              <li class="nav-item">
                <a id="buat_notula" class="nav-link active text-white" href="{{ url('/sekretaris/buat_notula') }}"><i class="fas fa-pen mx-2"></i> Buat Notulensi </a>
              </li>
              <li class="nav-item">
                <a id="profile" class="nav-link text-white" href="{{ url('/sekretaris/profile') }}" ><i class="fa-solid fa-user mx-2" style="color: #ffffff;"></i> Profile</a>
              </li>
              

            <!-- Tombol Logout -->
            <button class="btn btn-warning text-black mt-4" style="background-color: #ffda00; width: 100px; display: flex; align-items: center; justify-content: center; margin: auto;" onclick="Logout()">Logout</button>
          </div>
        </nav>
        <!--Sidebar END-->

        <!-- Content -->
        <main class="main absolute">
            <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="m-0 text-end">Edit Notula</h5>
                  </div>
                </div>
              </div>
          <!-- Your dashboard content goes here -->
          <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="d-flex align-items-center">
              <div>
                
              </div>
            </div>

             <!--menampilkan pesan jika error-->
             @if ($errors->any())
             <div class="pt-3">
               <div class="alert alert-danger">
                 <ul>
                   @foreach ($errors->all() as $item)
                   <li>{{$item}}</li> 
                   @endforeach
                 </ul>
               </div>
             </div>                
             @endif
 
             <!--menampilkan pesan berhasil disimpan-->
             @if (Session::has('success'))
             <div class="pt-3">
               <div class="alert alert-success">
                 {{Session::get('success')}}
 
               </div>
             </div>
                 
             @endif

            <form action="{{ route('sekretaris.update', $items->id) }}" method="POST" >
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="noUndangan">Nomor Undangan</label>
                <input type="text" class="form-control" id="noUndangan" name="undangan" value="{{ $items->undangan }}" />
              </div>
            <div class="form-group">
              <label for="topik_rapat">Topik Rapat</label>
              <input type="text" class="form-control" id="topik_rapat" name="topik_rapat" value="{{ $items->topik_rapat }}"  />
            </div>
            <div class="form-group">
              <label for="pemimpinRapat">Pemimpin Rapat</label>
              
              <select class="form-control" name= 'pemimpin_rapat_id' id="pemimpinRapat">@foreach($dataPesertaList as $peserta)
               
             <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
            @endforeach</select>
            </div>
            <div class="form-group">
              <label for="waktu_rapat">Waktu Rapat</label>
              <input type="datetime-local" class="form-control" id="waktu_rapat" name="waktu_rapat" value="{{ $items->waktu_rapat }}" />
            </div>
            <div class="form-group">
              <label for="tempat_rapat">Tempat Rapat</label>
              <input type="text" class="form-control" id="tempat_rapat" name="tempat_rapat" value="{{ $items->tempat_rapat }}"  />
            </div>
            <div class="form-group">
              <label for="notulensi_rapat">Notulensi Rapat</label>
              <textarea class="form-control" id="notulensi_rapat" rows="4" name="notulensi_rapat" value="{{ $items->notulensi_rapat }}" ></textarea>
            </div>
          
          <div class="d-flex justify-content-center mt-3">
            <a href="{{ url('/sekretaris/dashboard') }}" class="btn btn-secondary mr-2">Kembali</a>
            <button type="submit" class="btn btn-warning" onclick="editNotula()">Simpan</button>
          </div>
        </form>
          
         
  
        </main>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>


    <script>

// Fungsi untuk pindah page"

//fungsi untuk logout
function Logout() {
    console.log("Logout function called");
    window.location.href = "login";
  }
      // Tambahkan event listener ke tautan "Buat Notulensi"
      const buatNotulensiLink = document.getElementById("buat_notula");
      buatNotulensiLink.addEventListener("click", goToBuatNotula);

      // Fungsi untuk menangani peristiwa klik pada tautan "Buat Notulensi"
      function goToDashboard() {
        window.history.back()="dashboard";
    }

      function editNotula() {
    console.log("Edit function called");
    window.location.href = "edit_notula";
  }

      // Tambahkan event listener ke tautan "dashboard"
      const dashboardLink = document.getElementById("dashboard");
      dashboardLink.addEventListener("click", goToDashboard);
//Fungsi pindah END


//toggle sidebar
      const sidebar = document.getElementById("sidebar");
      const sidebarToggle = document.getElementById("sidebar-toggle");
      let isSidebarOpen = true; // Menyimpan status sidebar

      // Fungsi untuk menampilkan/menyembunyikan sidebar
      function toggleSidebar() {
        if (isSidebarOpen) {
          sidebar.classList.add("sidebar-hidden");
        } else {
          sidebar.classList.remove("sidebar-hidden");
        }
        isSidebarOpen = !isSidebarOpen;
      }

      // Tambahkan event listener ke tombol "sidebar-toggle"
      sidebarToggle.addEventListener("click", toggleSidebar);


    </script>
    
  </body>
</html>
