<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
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
  width: calc(120% - 240px); /* Lebar "main" adalah 100% - lebar sidebar */
  transition: margin-left 0.3s; /* Tambahkan efek transisi untuk perpindahan margin kiri */
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

      .custom-upload-btn {
        border: 2px solid #007bff;
        color: #007bff;
        background-color: #fff;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
      }

      .custom-upload-btn:hover {
        background-color: #007bff;
        color: #fff;
      }

      /* Custom Choose File button style */
      .custom-choose-file-btn {
        border: 2px solid #007bff;
        color: #007bff;
        background-color: #fff;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
      }

      .custom-choose-file-btn:hover {
        background-color: #007bff;
        color: #fff;
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
              <img src="{{ asset('img/SIANO_logo.png') }}" alt="Logo" />
              <!-- Toggle button -->
              <div id="sidebar-toggle" class="toggle-button mt-3">≡</div>
            </div>
            <div class="line"></div>
            <!-- Garis bawah baru -->
            <div id="button-container" class="position-absolute" style="top: 10px; left: 10px;">
              <!-- Buttons for Dashboard, Buat Notulensi, Profile go here -->
              <!-- ... -->
          </div>
          
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

            <button class="btn btn-warning text-black mt-4" style="background-color: #ffda00; width: 100px; display: flex; align-items: center; justify-content: center; margin: auto;" onclick="Logout()"><i class="fa-solid fa-right-from-bracket fa-rotate-180 mx-2"></i>Logout</button>
          </div>
        </nav>

        <!-- Content -->
        <main class="main absolute">
          <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="d-flex align-items-center">
              <div>
                <h5 class="m-0 text-end">Profile Settings</h5>
              </div>
            </div>
          </div>
          <!-- Your dashboard content goes here -->
    <div class="profile-container bg-white p-3 mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      <form id="profileForm">
        <div class=" mb-3 mt-3">
          <div class="d-flex align-items-center">
            <img src="{{ asset('img/profile.png') }}" alt="Profile" style="max-width: 80px; max-height: 80px; margin-right: 15px; margin-top: 5px;">
        <form>
          <div class="form-group">
            <label for="undanganFile">Foto Profil</label>
            <input type="file" class="form-control-file" id="undanganFile" name="undanganFile" accept=".pdf, .doc, .docx" />
          </div>
        </form>
    </div>
    <div class="mb-3">
      <label for="usernameInput" class="form-label" style="margin-top: 15px;">Username</label>
      <input type="text" class="form-control" id="usernameInput" placeholder="Enter your username">
    </div>
    <div class="mb-3">
      <label for="passwordInput" class="form-label">Password</label>
      <input type="password" class="form-control" id="passwordInput" placeholder="Enter your password">
    </div>
    <div class="mb-3">
      <label for="newPasswordInput" class="form-label">New Password</label>
      <input type="password" class="form-control" id="newPasswordInput" placeholder="Enter your new password">
    </div>
    <button type="button" class="btn btn-primary" onclick="saveProfile()">Save Profile</button>
  </form>
</div>

          </div>
          <!-- Footer -->
          <footer class="fixed-bottom text-white text-center " style=" background-color: #242564; padding:5px">
            © 2023, made with by Vokasi UB
          </footer>
  <!-- Footer End -->
  
        </main>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>

// Fungsi untuk pindah page"

    // Your existing JavaScript code and functions go here

    function saveProfile() {
        // Get values from form inputs
        const username = document.getElementById("usernameInput").value;
        const password = document.getElementById("passwordInput").value;
        const newPassword = document.getElementById("newPasswordInput").value;

        // Perform validation if needed

        // Add logic to handle the form submission (e.g., update user profile on the server)
        console.log("Saving profile...");
        console.log("Username:", username);
        console.log("Password:", password);
        console.log("New Password:", newPassword);
    }

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
  const mainContent = document.querySelector(".main");

  if (isSidebarOpen) {
    sidebar.classList.add("sidebar-hidden");
    mainContent.style.marginLeft = "40px"; // Add space when sidebar is closed
  } else {
    sidebar.classList.remove("sidebar-hidden");
    mainContent.style.marginLeft = "250px"; // Adjust the value based on your sidebar width
  }

  isSidebarOpen = !isSidebarOpen;
}

// Tambahkan event listener ke tombol "sidebar-toggle"
sidebarToggle.addEventListener("click", toggleSidebar);

    </script>
    
  </body>
</html>
