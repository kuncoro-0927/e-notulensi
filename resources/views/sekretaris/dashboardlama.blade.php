<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

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

      #myTable {
    width: 100%;
    border-collapse: collapse;
  }

  #myTable th, #myTable td {
    padding: 8px;
    text-align: left;
  }

  #myTable th {
    background-color: #242564;
    color: white;
  }

  #myTable tbody tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
  }

  #myTable tbody tr.selected {
    background-color: #c1bfb4;
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

            <!-- isi sidebar-->
            <div class="line"></div>
            <ul class="nav flex-column mt-4">
              <!-- mt-4 untuk memberi margin atas -->
              <li class="nav-item">
                <a class="nav-link active text-white" href="dashboard"> <i class="fas fa-home mx-2"></i> Dashboard </a>
              </li>
              <li class="nav-item">
                <a id="buatNotulensiLink" class="nav-link text-white" href="buat_notula"><i class="fas fa-pen mx-2"></i> Buat Notulensi </a>
              </li>
              <li class="nav-item">
                <a id="profile" class="nav-link text-white" href="profile" ><i class="fa-solid fa-user mx-2" style="color: #ffffff;"></i> Profile</a>
              </li>
            <button class="btn btn-warning text-black mt-4" style="background-color: #ffda00; width: 100px; display: flex; align-items: center; justify-content: center; margin: auto;" onclick="Logout()">Logout</button>
          </div>
        </nav>
                    <!-- isi sidebar end-->


        <!-- Content -->
        <main class="main absolute">
          <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="d-flex align-items-center">
              <i class="fa-regular fa-user mx-2 text-end" style="color: #000000;"></i>
              <div>
                <h5 class="m-0 text-end">Sekretaris</h5>
              </div>
            </div>
          </div>
          <!-- Your dashboard content goes here -->
          <table id="notulensi" class="table table-striped" style="width:100%">
            <thead >
                <tr>
                    <th>Nomor Undangan</th>
                    <th>Pemimpin Rapat</th>
                    <th>Topik Rapat</th>
                    <th>Tempat Rapat</th>
                    <th>Tanggal Rapat</th>
                    <th>Jumlah Peserta</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
              @foreach ($items as $item)
                <tr>
                  
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->pemimpin_rapat }}</td>
                    <td>{{ $item->topik_rapat }}</td>
                    <td>{{ $item->tempat_rapat }}</td>
                    <td>{{ $item->waktu_rapat }}</td>
                    <td>32</td>
                    
                  
                    <td>
                      <a href="{{ route('sekretaris.edit_notula', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                      <button class="btn btn-success btn-sm" onclick="uploadNotula()">Upload</button>
                      <button class="btn btn-warning btn-sm" onclick="presensi()">Presensi</button>
                      <a href="{{ route('download.file', ['id' => $item->id]) }}" download="{{ $item->original_filename }}" class="btn btn-danger btn-sm">Print</a>
                      
                      

                    </td>
                    
                    @endforeach
                </tr>
                
                
            </tbody>
           
            
        </table>
        
      

          </div>
        </main>
        
        <!--Dashboard End-->

      </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script  src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script  src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script  src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    
    <script>
      $(document).ready(function () {
        $('#notulensi').DataTable();
      });
    
      
//
 // Function to populate the presensi modal with sample data
 

      // Fungsi untuk menangani peristiwa klik pada tautan "Buat Notulensi"
     

      // Tambahkan event listener ke tautan "Buat Notulensi"
      const buatNotulensiLink = document.getElementById("buatNotulensiLink");
      buatNotulensiLink.addEventListener("click", goToBuatNotula);

      //fungsi untuk logout
      function Logout() {
    console.log("Logout function called");
    window.location.href = "login";
  }

      // Fungsi untuk menangani peristiwa klik pada tombol CRUD"

      function uploadNotula() {
    console.log("upload function called");
    window.location.href = "upload";
  }
  

  function printNotula() {
    console.log("Print function called");
    
  }

  // Fungsi untuk menangani peristiwa klik pada tombol "Print"

  // Implement the print functionality here


  // Fungsi untuk menangani peristiwa klik pada tombol CRUD"
  
  function editNotula() {
    console.log("Edit function called");
    window.location.href = "edit_notula";
  }
  

 
  //CRUD END

      const sidebar = document.getElementById("sidebar");
      const sidebarToggle = document.getElementById("sidebar-toggle");
      let isSidebarOpen = true; 
      // Menyimpan status sidebar

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
