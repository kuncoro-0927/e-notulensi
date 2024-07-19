<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Dashboard</title>
    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

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

      /* card unit */
      .custom-card {
        background-color: #ffda00;

        border-radius: 15px;
        margin: 0 15px 15px 0;
      }

      .custom-card h6 {
        font-size: medium;
        height: 40px;
        overflow: hidden;
      }

      .custom-card p {
        font-size: 25px;
      }

      /* footer */
      footer {
        background-color: #242564;
        color: #fff;
        text-align: center;
        padding: 5px;
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
                <a class="nav-link text-white" href="/superadmin/dashboard"><i class="fas fa-home mx-2"></i> Dashboard </a>
              </li>
              <li class="nav-item sidebar-item" data-backgroundColor="#395085">
                <a class="nav-link text-white" href="/superadmin/sekretaris"><i class="fa-solid fa-book-open-reader mx-2"></i>Sekretaris </a>
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
        <main class="main absolute" id="dashboard-content">
          <!-- Profil dan Form Pencarian -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Form Pencarian -->
            <form class="search-form">
              <div class="input-group">
                <input class="form-control" type="text" style="width: 500px" placeholder="Search...." />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
            <!-- profile -->
            <div class="dropdown">
              <a class="btn btn-light dropdown-toggle" href="profile" role="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #fff">
                <img src={{ asset('img/profilemark.jpg') }} alt="Profile Image" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover" />
                Super Admin
              </a>
              <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="edit_profile">Profile</a>
                <a class="dropdown-item" href="#">Logout</a>
              </div>
            </div>
          </div>

          <!-- Your dashboard content goes here -->
          <h3>Selamat datang,Super Admin</h3>
          <h5>Vokasi Universitas Brawijaya</h5>

          <!-- Statistik Container -->
          <div class="container-fluid mt-4">
            <!-- Card untuk menampilkan total notulensi unit -->
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="card text-black shadow custom-card">
                  <div class="card-body">
                    <h6 class="card-title">Departemen Bisnis dan Hospitality</h6>
                    <p class="card-text font-weight-bold">18</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card text-black shadow custom-card">
                  <div class="card-body">
                    <h6 class="card-title">Departemen Industri Kreatif dan Digital</h6>
                    <p class="card-text font-weight-bold">30</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card text-black shadow custom-card">
                  <div class="card-body">
                    <h6 class="card-title">PSIK</h6>
                    <p class="card-text font-weight-bold">25</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Diagram Statistik -->
            <div class="row">
              <div class="col-6">
                <div class="card">
                  <div class="card-header" style="background-color: rgb(0, 0, 0); color: #fff">Peserta</div>
                  <div class="card-body">
                    <div id="chart1"></div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card">
                  <div class="card-header" style="background-color: black; color: #fff">Notulensi</div>
                  <div class="card-body">
                    <div id="chart2"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

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

    <!-- chart js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0"></script>
    <!-- Chart -->
    <script>
      // chart pertama
      var options = {
        series: [
          {
            name: "series1",
            data: [31, 40, 28, 51, 42, 109, 100],
          },
          {
            name: "series2",
            data: [11, 32, 45, 32, 34, 52, 41],
          },
        ],
        chart: {
          height: 350,
          type: "area",
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "smooth",
        },
        xaxis: {
          type: "datetime",
          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"],
        },
        tooltip: {
          x: {
            format: "dd/MM/yy HH:mm",
          },
        },
      };

      var chart = new ApexCharts(document.querySelector("#chart1"), options);
      chart.render();

      // chart kedua
      var options = {
        series: [
          {
            name: "PSIK",
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
          },
          {
            name: "Departemen Industri Kreatif dan Digital",
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
          },
          {
            name: "Departemen Busnis dan Hospitality",
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
          },
        ],
        chart: {
          type: "bar",
          height: 350,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        xaxis: {
          categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
        },
        yaxis: {
          title: {
            text: "$ (thousands)",
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands";
            },
          },
        },
      };

      var chart = new ApexCharts(document.querySelector("#chart2"), options);
      chart.render();
    </script>

    <!-- Footer -->
    <footer class="footer">&copy; 2023, made with by Vokasi UB</footer>
  </body>
</html>
