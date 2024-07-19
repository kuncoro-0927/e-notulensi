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
                <a id="dashboardLink" class="nav-link active text-white" href="dashboard" > <i class="fas fa-home mx-2"></i> Dashboard </a>
              </li>
              <li class="nav-item">
                <a id="buatNotulensiLink" class="nav-link active text-white" href="buat_notula"><i class="fas fa-pen mx-2"></i> Buat Notulensi </a>
              </li>
              <li class="nav-item">
                <a id="profile" class="nav-link text-white" href="profile" ><i class="fa-solid fa-user mx-2" style="color: #ffffff;"></i> Profile</a>
              </li>

            <!-- Tombol Logout -->
            <button class="btn btn-warning text-black mt-4" style="background-color: #ffda00; width: 100px; display: flex; align-items: center; justify-content: center; margin: auto;" onclick="Logout()">Logout</button>
          </div>
        </nav>

        <!-- Content -->
        <main class="main absolute">
          <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="d-flex align-items-center">
              <div>
                <h5 class="m-0 text-end">Buat Notula</h5>
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
          <form action="{{route('sekretaris.buat_notula')}}" method= "POST">
            @csrf
            <div class="form-group">
              <label for="noUndangan">Nomor Undangan</label>
              <input type="text" class="form-control" id="noUndangan" name="undangan" placeholder="Masukkan Nomor Undangan" />
            </div>
            <div class="form-group">
              <label for="topikRapat">Topik Rapat</label>
              <input type="text" class="form-control" name= 'topik_rapat' id="topikRapat" placeholder="Masukkan topik rapat" />
            </div>
            <div class="form-group">
              <label for="pemimpinRapat">Pemimpin Rapat</label>
              
              <select class="form-control" name= 'pemimpin_rapat_id' id="pemimpinRapat">@foreach($dataPesertaList as $peserta)
               
             <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
            @endforeach</select>
            </div>

            <div class="form-group">
              <label for="waktuRapat">Waktu Rapat</label>
              <input type="datetime-local" class="form-control" name= 'waktu_rapat'id="waktuRapat" />
            </div>
            <div class="form-group">
              <label for="tempatRapat">Tempat Rapat</label>
              <input type="text" class="form-control" name= 'tempat_rapat'id="tempatRapat" placeholder="Masukkan tempat rapat" />
            </div>
            <div class="form-group">
              <label for="notulensiRapat">Notulensi Rapat</label>
              <textarea class="form-control" name= 'notulensi_rapat' id="notulensiRapat" rows="4" placeholder="Masukkan notulensi rapat"></textarea>
            </div>
    
            <button type="submit" class="btn btn-primary ">Simpan</button>
          </div>
        </form>
          <!-- Footer -->
          <footer class="fixed-bottom text-white text-center py-2" style="width: 100%; background-color: #242564;">
            © 2023, made with by Vokasi UB
          </footer>
  <!-- Footer End -->
  
        </main>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>


    <script>

// Fungsi untuk pindah page"
function goToBuatNotula() {
        console.log("Function called");
        window.location.href = "buat_notula";
      }

//fungsi untuk logout
function Logout() {
    console.log("Logout function called");
    window.location.href = "/login";
  }

      // Tambahkan event listener ke tautan "Buat Notulensi"
      const buatNotulensiLink = document.getElementById("buatNotulensiLink");
      buatNotulensiLink.addEventListener("click", goToBuatNotula);

      // Fungsi untuk menangani peristiwa klik pada tautan "Buat Notulensi"
      function goToDashboard() {
        console.log("Function called");
        window.location.href = "dashboard";
      }

      // Tambahkan event listener ke tautan "Buat Notulensi"
      const dashboardLink = document.getElementById("dashboardLink");
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
