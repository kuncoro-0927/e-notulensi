<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Sekretaris</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
  transition: margin-left 0.7s; /* Tambahkan efek transisi untuk perpindahan margin kiri */
}

.main.sidebar-hidden {
      width: calc(100% - 50px); /* Adjust the value based on your sidebar width */
    }


      /* Menyembunyikan garis bawah pada tautan di dalam elemen dengan kelas "toggle-button" */
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
      .wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
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
              <button class="btn btn-warning text-black mt-4" style="background-color: #ffda00; width: 100px; display: flex; align-items: center; justify-content: center; margin: auto;" onclick="Logout()"><i class="fa-solid fa-right-from-bracket fa-rotate-180 mx-2"></i>Logout</button>
            </div>
        </nav>
                    <!-- isi sidebar end-->

        <!-- Content -->
        <div class="wrapper">
        <main class="main absolute">
          <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="d-flex align-items-center">
              <i class="fa-regular fa-user mx-2 text-end" style="color: #000000;"></i>
              <div>
                <h5 class="m-0 text-end">Sekretaris </h5>
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
              @foreach ($jumlah as $save => $item)
                <tr>
                    <td>{{ $item->undangan }}</td>
                    <td>{{ $item->pemimpin_rapat }}</td>
                    <td>{{ $item->topik_rapat }}</td>
                    <td>{{ $item->tempat_rapat }}</td>
                    <td>{{ $item->waktu_rapat }}</td>
                    
                    <td>{{ $item->total_hadir }}</td>
                   
                    <td>
                      
                      <a href="{{ route('sekretaris.edit_notula', $item->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> 
                    </a>
                    <a href="{{ route('upload.form', $item->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-upload"></i> 
                    </a>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#presensiModal{{ $item->id }}">
                      <i class="fa-solid fa-list-check" style="color: #000000;"></i> 
                  </button>
                      <a href ="{{ route('detail.rapat', ['id' => $item->id]) }}"  class="btn btn-info btn-sm">
                      <i class="fas fa-info-circle"></i> 
                    </a>
                    </td>
                    @endforeach
                
        
            </tbody>
        </table>
          </div>

        </main>
        <!--Dashboard End-->

<!--  Modal Prensisi (popup)-->
@foreach ($items as $item)
  
<div class="modal fade" id="presensiModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="presensiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="presensiModalLabel">Pilih Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('dashboard.store-presensi', ['id' => $item->id]) }}" method="post">
        @csrf
      <div class="modal-body">
        <div class="mb-3">
          <input type="text" id="searchInput" class="form-control" placeholder="Search">
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama</th>
              <th>NIP</th>
              <th>Kehadiran</th>
            </tr>
          </thead>
          <tbody> 
            @foreach ($datas as $data)
            
            <tr>
              <td>{{ $data->id }}</td>
              <td>{{ $data->nama }}</td>
              <td>{{ $data->nip }}</td>
              
              
                <input type="hidden" name="notula_id" value="{{ $item->id }}">
                <label for="peserta_id{{ $data->id }}">
               <td><input type="checkbox" name="peserta_id[]" id="peserta_id{{ $data->id }}" data-notula-id="{{ $item->id }}" value="{{ $data->id }}" {{ old('peserta_id') && in_array($data->id, old('peserta_id')) ? 'checked' : '' }} ></td>
              </label>
            
            </tr>
            @endforeach
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                  var checkboxes = document.querySelectorAll('input[name="peserta_id[]"]');
                  
                  checkboxes.forEach(function(checkbox) {
                      var notulaId = checkbox.dataset.notulaId; // Menggunakan data-notula-id dari atribut dataset
                      var participantId = checkbox.value;
            
                      // Ambil status terakhir dari localStorage berdasarkan notula_id
                      var isChecked = localStorage.getItem('peserta_' + notulaId + '_' + participantId) === 'true';
                      
                      // Set status checkbox
                      checkbox.checked = isChecked;
            
                      // Tambahkan event listener untuk meng-handle perubahan checkbox
                      checkbox.addEventListener('change', function() {
                          localStorage.setItem('peserta_' + notulaId + '_' + participantId, checkbox.checked);
                      });
                  });
              });
            </script>
            
           
            <!-- Tambahkan baris sesuai dengan kebutuhan -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        
        <a href="{{ route('print.presensi', $item->id) }}" id="printButton{{$item->id}}" class="btn btn-danger">Print</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </td>
    </div>
  </div>
</div>

@endforeach

<!--modal presensi end-->

<footer class="text-white text-center " style=" background-color: #242564; padding:5px;">
  © 2023, made with by Vokasi UB
</footer>
</div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script  src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script  src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script  src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!--data table-->
    <script>
      $(document).ready(function () {
        $('#notulensi').DataTable();
      });

      $('#searchInput').on('keyup', function () {
      presensiTable.search(this.value).draw();
    });
  ;
    </script>
  <!--data table end-->  

        <script>
      
  
 // Function to populate the presensi modal with sample data
 $('#presensiModal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})

      

      //fungsi untuk logout
      function Logout() {
    console.log("Logout function called");
    window.location.href = "/login";
  }

      // Fungsi untuk menangani peristiwa klik pada tombol CRUD"
  function editNotula() {
    console.log("Edit function called");
    window.location.href = "edit_notula";
  }

  function uploadNotula() {
    console.log("upload function called");
    window.location.href = "upload";
  }
  function detailNotula() {
        console.log("Detail function called");
        window.location.href = "detail";
        // Add your logic for handling the detail action
    }
  // Fungsi untuk menangani peristiwa klik pada tombol "Print"


 
  //CRUD END

  const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const mainContent = document.querySelector(".main");
    let isSidebarOpen = true;

    function toggleSidebar() {
      if (isSidebarOpen) {
        sidebar.classList.add("sidebar-hidden");
        mainContent.classList.add("sidebar-hidden");
      } else {
        sidebar.classList.remove("sidebar-hidden");
        mainContent.classList.remove("sidebar-hidden");
      }

      isSidebarOpen = !isSidebarOpen;
    }

    sidebarToggle.addEventListener("click", toggleSidebar);
    </script>
  </body>
</html>
