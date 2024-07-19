<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sekretaris</title>
    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- css databel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link
      rel="stylesheet"
      href="
    https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css"
    />

    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- js datatabel -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
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
      /* Efek hover pada menu sidebar */
      .sidebar-item:hover {
        background-color: #395085; /* Warna latar belakang saat hover */
      }

      /*Main  */
      .container-fluid {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }
      .main {
        margin-left: 250px; /* Atur margin kiri untuk memberi ruang pada sidebar */
        padding: 20px;
        z-index: 1; /* Main berada di bawah sidebar */
        position: relative;
        width: calc(100% - 250px); /* Lebar "main" adalah 100% - lebar sidebar */
        transition: margin-left 0.7s; /* Tambahkan efek transisi untuk perpindahan margin kiri */
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

      /* footer */
      footer {
        background-color: #242564;
        color: #fff;
        text-align: center;
        padding: 5px;
      }

      /* tabel  */
      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th,
      td {
        border: 1px solid #6d6a6a;
        padding: 8px;
        text-align: left;
      }

      button {
        margin-right: 5px;
      }
      /* button tambah */
      .tambah-button-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
      }

      .tambah-button {
        margin-right: 5px;
        height: 40px;
        border-radius: 8px;
        background-color: rgb(0, 178, 0);
      }
      .tambah-button:hover,
      .tambah-button:active {
        background-color: #1a9637;
      }
      .tambah-button i {
        margin-right: 5px;
      }

      /* button Edit Hapus */
      .btn-edit,
      .btn-hapus {
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 13px;
      }

      .btn-edit {
        background-color: #007bff;
      }

      .btn-edit:hover {
        background-color: #0056b3;
      }

      .btn-hapus {
        background-color: #dc3545;
      }

      .btn-hapus:hover {
        background-color: #c82333;
      }

      /* alert hapus */
      .confirm-modal {
        display: none;
        position: fixed; /* Change to fixed */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
      }

      .confirm-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        position: relative;
      }

      .confirm-box p {
        margin-bottom: 20px;
      }

      .confirm-box button {
        padding: 10px 20px;
        margin-right: 10px;
        cursor: pointer;
      }

      .confirm-box button.ok {
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 5px;
      }

      .confirm-box button.cancel {
        background-color: #ccc;
        color: #000;
        border: none;
        border-radius: 5px;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- /navbar   -->
        
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
          <div class="d-flex flex-column align-items-center position-sticky">
            <!-- Logo -->
            <div class="logo-container">
              <img src="{{ asset('img/SIANO FIXX Putih.png') }}" alt="Logo" />
              <!-- Toggle button -->
              <div id="sidebar-toggle" class="toggle-button mt-3">≡</div>
            </div>
            <div class="line"></div>
            <!-- Garis bawah baru -->

            <ul class="nav flex-column mt-4">
              <!-- mt-4 untuk memberi margin atas -->
              <li class="nav-item sidebar-item" data-backgroundColor="#395085">
                <a class="nav-link text-white" href="dashboard" ><i class="fas fa-home mx-2"></i> Dashboard </a>
              </li>
              <li class="nav-item sidebar-item" data-backgroundColor="#395085">
                <a class="nav-link text-white" href="sekretaris"><i class="fa-solid fa-book-open-reader mx-2"></i>Sekretaris </a>
              </li>
              <li class="nav-item sidebar-item" data-backgroundColor="#395085">
                <a class="nav-link text-white" href="peserta"><i class="fa-solid fa-users mx-2" ></i> Peserta </a>
              </li>
              <li class="nav-item sidebar-item" data-backgroundColor="#395085">
                <a class="nav-link text-white" href="notulensi"><i class="fa-regular fa-note-sticky mx-2"></i> Notulensi </a>
              </li>
              <li class="nav-item sidebar-item">
                <a class="nav-link collapsed text-white" data-toggle="collapse" href="#datamaster" aria-expanded="false"><i class="fa-solid fa-brain mx-2"></i> Data Master</a>
                <ul id="datamaster" class="sidebar-dropdown list-unstyled collapse">
                  <li class="nav-item sidebar-item">
                    <a href="dataunit" class="nav-link text-white"><i class="fa-solid fa-chevron-right mx-2"></i> Unit</a>
                  </li>
                  <li class="nav-item sidebar-item">
                    <a href="datajabatan" class="nav-link text-white"><i class="fa-solid fa-chevron-right mx-2"></i> Jabatan</a>
                  </li>
                </ul>
              </li>
            </ul>

            <!-- Tombol Logout -->
            <a href="/login" class="btn btn-warning text-black mt-4" style="background-color: #ffda00"><i class="fa-solid fa-right-from-bracket fa-rotate-180 mx-2"></i>Logout</a>
          </div>
        </nav>

        <!-- Content -->
        <div class="container-fluid" style="display: flex">
            <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <main class="main absolute">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Data Sekretaris</h3>
  
                <!-- tambah sekre -->
                <button class="btn btn-primary tambah-button" data-toggle="modal" data-target="#tambahSekretarisModal"><i class="fas fa-plus"></i> Tambah</button>
              </div>
            <!-- tambah sekre -->

            <!-- Tabel Sekretaris  -->
            <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <table id="example" class="table table-striped table-bordered" style="width: 100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>Unit</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
            $nomorUrut = 1;
        @endphp
                @foreach ($sekre as $data)
                @if ($data->role_id == 2)
                <tr>
                  <td>{{ $nomorUrut++ }}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->nip}}</td>
                  <td>{{$data->unit}}</td>
                  <td>
                    <button class="btn btn-edit" data-toggle="modal" data-target="#editSekretarisModal{{$data->id}}">Edit</button>
                    <button class="btn btn-hapus" onclick="hapusSekretaris({{$data->id}})">Hapus</button>
                  </td>
                </tr>
                @endif
                @endforeach
               
                <!-- Batas Tabel-->
              </tbody>
            </table>

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
            
            <!-- Modal untuk konfirmasi hapus -->
            @foreach ($sekre as $data)
            <form action="{{ route('users.destroy', ['id' => $data->id]) }}"method="POST">
              @method('DELETE')
              @csrf
            <div id="confirmModal{{$data->id}}" class="confirm-modal">
              <div class="confirm-box">
                <p>Apakah Anda yakin ingin menghapus sekretaris ini?</p>
                <button type="submit" class="ok float-right" onclick="hapusSekretarisKonfirmasi( true)">Ya</button>
                <button class="cancel" onclick="hapusSekretarisKonfirmasi(false)">Tidak</button>
              
              </div>
            
            </div>
            </form>
            @endforeach
            
            
          
          
          </main>

          <!-- Modal Tambah Sekretaris -->
          <div class="modal" tabindex="-1" role="dialog" id="tambahSekretarisModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Sekretaris</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- form untuk menambahkan data sekretaris -->
                  <form action="{{ route('superadmin.tambahsekre') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="nip">NIP:</label>
                      <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" required />
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama:</label>
                      <input type="text" class="form-control" id="nama" name="name" placeholder="Masukkan Nama" required />
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required />
                    </div>
                    <div class="form-group">
                      <label for="password">Password:</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Minim 8 Karakter" required />
                    </div>
                    <div class="form-group">
                      <label for="unit">Unit</label>
                      <!--  dropdown untuk pilihan unit -->
                      <select class="form-control" id="unit" name="unit" required>
                        @foreach ($units as $unit)
                        <option value="{{$unit->nama_unit}}">{{$unit->nama_unit}}</option>
                @endforeach
                      </select>
                    </div>
                    <!-- Menambahkan input tersembunyi untuk role -->
                   <input type="hidden" name="role_id" value="2">
                 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" onclick="simpanSekretaris()">Simpan</button>
                </div>
              </form>
              </div>
            </div>
          </div>

          @foreach ($sekre as $data)
          <!-- Modal Edit Sekretaris -->
          <div class="modal" tabindex="-1" role="dialog" id="editSekretarisModal{{$data->id}}">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Sekretaris</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!--  form untuk mengubah data sekretaris -->
                  <form action="{{ route('update-datasekre', ['id' => $data->id]) }}"method="POST">
                    @method('PUT')
                    @csrf
                    
                    <div class="form-group">
                      <input type="hidden" class="form-control" value="{{$data->id}}" name='id' id="id">
                      <label for="nip">NIP:</label>
                      <input type="text" class="form-control" id="nip" name="nip" value="{{$data->nip}}" />
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama:</label>
                      <input type="text" class="form-control" id="nama"  name="name" value="{{$data->name}}" />
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" />
                    </div>
                    <div class="form-group">
                      <label for="password">Password:</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Minim 8 Karakter" required />
                    </div>
                    <div class="form-group">
                      <label for="unit">Unit</label>
                      <!--  dropdown untuk pilihan unit -->
                      
                      <select class="form-control" id="unit" name="unit" required>
                        @foreach ($units as $unit)
                        <option value="{{$unit->nama_unit}}">{{$unit->nama_unit}}</option>
                @endforeach
                      </select>
                    </div>
                    <!-- Menambahkan input tersembunyi untuk role -->
                   <input type="hidden" name="role_id" value="2">
                   
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" onclick="simpanSekretaris()">Simpan</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  
    <!-- JS -->
    <script>
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

    <!-- tambah data -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi modal
        $("#tambahSekretarisModal").modal({
          backdrop: "static",
          keyboard: false,
          show: false,
        });

        // Fungsi untuk menampilkan modal
        function showTambahSekretarisModal() {
          $("#tambahSekretarisModal").modal("show");
        }

        // Fungsi untuk menyembunyikan modal
        function hideTambahSekretarisModal() {
          $("#tambahSekretarisModal").modal("hide");
        }

        // event listener ke tombol "Tambah"
        document.querySelector(".tambah-button").addEventListener("click", showTambahSekretarisModal);

        // event listener ke tombol "Simpan" di dalam modal
        document.querySelector("#tambahSekretarisModal .btn-primary").addEventListener("click", function () {
          console.log("Simpan data sekretaris");

          // Setelah menyimpan, sembunyikan modal
          hideTambahSekretarisModal();
        });
      });
    </script>

    <!-- Script untuk modal edit -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi modal
        $("#editSekretarisModal").modal({
          backdrop: "static",
          keyboard: false,
          show: false,
        });

        // Fungsi untuk menampilkan modal
        function showEditSekretarisModal() {
          $("#editSekretarisModal").modal("show");
        }

        // Fungsi untuk menyembunyikan modal
        function hideEditSekretarisModal() {
          $("#editSekretarisModal").modal("hide");
        }

        // Event listener ke tombol "Edit"
        document.querySelector(".btn-edit").addEventListener("click", showEditSekretarisModal);

        // Event listener ke tombol "Simpan" di dalam modal
        document.querySelector("#editSekretarisModal .btn-primary").addEventListener("click", function () {
          console.log("Simpan data sekretaris");

          // Setelah menyimpan, sembunyikan modal edit
          hideEditSekretarisModal();
        });
      });
    </script>

    <!-- hapus data -->
    <script>
      // Menampilkan modal konfirmasi hapus
      @foreach ($datas as $data)
      function showConfirmModal() {
        const confirmModal = document.getElementById("confirmModal" + {{$data->id}});
        confirmModal.style.display = "flex";
      }
@endforeach
      // Menyembunyikan modal konfirmasi hapus
      function hideConfirmModal() {
        const confirmModal = document.getElementById("confirmModal");
        confirmModal.style.display = "none";
      }
      

      // Menggunakan modifikasi fungsi hapusSekretaris
      function hapusSekretaris(id) {
        // Tampilkan modal konfirmasi hapus
        showConfirmModal();
        
        // Simpan ID yang akan dihapus
        idToDelete = id;
      }
     

      // Fungsi konfirmasi hapus untuk memberikan tindakan setelah konfirmasi
      function hapusSekretarisKonfirmasi(confirmation) {
        // Sembunyikan modal konfirmasi hapus
        hideConfirmModal();

        // Jika dikonfirmasi (OK), hapus data sekretaris
        if (confirmation) {
          console.log("Hapus Sekretaris dengan ID: " + idToDelete);
        }
       
      }
    </script>
    <script>
      new DataTable("#example");
    </script>

    <!-- Footer -->
    <footer class="footer">&copy; 2023, made with by Vokasi UB</footer>
  </body>
</html>
