<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notulensi</title>
    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />

    <!-- css data tabel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link
      rel="stylesheet"
      href="
    https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css"
    />

    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

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
        border: 1px solid #020202;
        padding: 8px;
        text-align: left;
      }

      /* bagian action */
      th.action-column {
        width: 180px; /* Sesuaikan dengan lebar yang diinginkan */
      }

      button {
        margin-right: 5px;
      }
      /* button tambah */

      .tambah-button {
        margin-right: 5px;
        height: 40px;
        border-radius: 8px;
        background-color: rgb(0, 178, 0);
        margin-left: 85%;
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
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 13px;
      }

      .btn-edit {
        background-color: #007bff;
        color: #fff;
      }

      .btn-hapus {
        background-color: #dc3545;
        color: #fff;
      }

      .btn-edit:hover {
        background-color: #0056b3;
      }

      .btn-hapus:hover {
        background-color: #c82333;
      }

      /* button Print dan Save PDF */
      .print-pdf-buttons {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
      }
      .print-button,
      

      .print-button {
        background-color: rgb(120, 120, 120);
        color: #fff;
      }
      .pdf-button {
        background-color: #007bff;
        color: #fff;
      }

      .print-button:hover {
        background-color: #6c6c6c;
      }

      .pdf-button:hover {
        background-color: #0056b3;
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
                <a class="nav-link text-white" href="dashboard"><i class="fas fa-home mx-2"></i> Dashboard </a>
              </li>
              <li class="nav-item sidebar-item" data-backgroundColor="#395085">
                <a class="nav-link text-white" href="sekretaris"><i class="fa-solid fa-book-open-reader mx-2"></i>Sekretaris </a>
              </li>
              <li class="nav-item sidebar-item" data-backgroundColor="#395085">
                <a class="nav-link text-white" href="peserta"><i class="fa-solid fa-users mx-2"></i> Peserta </a>
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
          <main class="main absolute main-content">
            <h3>Data Notulensi</h3>

            <!-- Tabel Notulensi  -->
            <table id="tabelNotulensi" class="table table-striped table-bordered" style="width: 100%">
              <thead>
                <tr>
                  <th>ID Rapat</th>
                  <th>Tanggal</th>
                  <th>Unit</th>
                  <th>Nama File Notulensi</th>
                  <th class="action-column">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->waktu_rapat}}</td>
                  <td>Unit A</td>
                  <td>{{$item->topik_rapat}}.pdf</td>
                  <td>
                    <div class="d-flex justify-content-center">
                    <a href="{{ route('notula.print', $item->id) }}" id="printButton{{$item->id}}" class="btn btn-danger text-white "  >
                      <i class="fas fa-print mx-2"></i>
                    </a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <!-- batas tabel -->
              </tbody>
            </table>

            <!-- Modal alert untuk konfirmasi hapus -->
            <div id="confirmModal" class="confirm-modal">
              <div class="confirm-box">
                <p>Apakah Anda yakin ingin menghapus data notulensi ini?</p>
                <button class="ok float-right" onclick="hapusNotulensiKonfirmasi(true)">Ya</button>
                <button class="cancel" onclick="hapusNotulensiKonfirmasi(false)">Tidak</button>
              </div>
            </div>
            <!-- batas modal alert konfirmasi hapus -->
          </main>
        </div>
      </div>
    </div>
    <!-- JS -->
    <script>
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

      // tambah sekretaris
      function tambahNotulensi() {
        // Logika untuk menambahkan data sekretaris
        console.log("Tambah Notulensi");
      }

      function editNotulensi(id) {
        // Logika untuk mengedit data sekretaris
        console.log("Edit Notulensi dengan ID: " + id);
      }

      // Tombol Print dan Save PDF
      const printButton = document.getElementById("printButton");
      const pdfButton = document.getElementById("pdfButton");

      //  event listener ke tombol "Print"
      printButton.addEventListener("click", function () {
        window.print();
      });

      //  event listener ke tombol "Save PDF"
      pdfButton.addEventListener("click", function () {
        const table = $("#tabelNotulensi").DataTable();
        table.button(0).trigger();
      });
    </script>

    <!-- script alert hapus -->
    <script>
      // Menampilkan modal konfirmasi hapus
      function showConfirmModal() {
        const confirmModal = document.getElementById("confirmModal");
        confirmModal.style.display = "flex";
      }

      // Menyembunyikan modal konfirmasi hapus
      function hideConfirmModal() {
        const confirmModal = document.getElementById("confirmModal");
        confirmModal.style.display = "none";
      }

      // Menggunakan modifikasi fungsi hapus notulensi
      function hapusNotulensi(id) {
        // Tampilkan modal konfirmasi hapus
        showConfirmModal();

        // Simpan ID yang akan dihapus
        idToDelete = id;
      }

      // Fungsi konfirmasi hapus untuk memberikan tindakan setelah konfirmasi
      function hapusNotulensiKonfirmasi(confirmation) {
        // Sembunyikan modal konfirmasi hapus
        hideConfirmModal();

        // Jika dikonfirmasi (OK), hapus data notulensi
        if (confirmation) {
          console.log("Hapus Notulensi dengan ID: " + idToDelete);
        }
      }
    </script>

    <!-- JS databel -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <!-- JS untuk Print dan Save PDF -->
    <script src="https://cdn.datatables.net/buttons/2.2.9/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.print.min.js"></script>
    <!-- JS untuk DataTables PDFMake -->
    <script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script>
      new DataTable("#tabelNotulensi");
    </script>

    <!-- Footer -->
    <footer class="footer">&copy; 2023, made with by Vokasi UB</footer>
  </body>
</html>
