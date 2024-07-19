<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
      body {
        background-color: #f8f9fa;
      }
      h2 {
        color: #242564;
      }
      .profile-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        margin-top: 20px; /* Adjusted margin-top */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
      }

      .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
      }

      .btn-upload {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
      }

      .upload-btn-wrapper input[type="file"] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
      }

      .edit-form {
        margin-top: 20px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .password-toggle {
        position: absolute;
        right: 10px;
        top: 40%;
        cursor: pointer;
      }

      /* button upload */
      .btn-upload {
        width: 180px;
        height: 40px;
        font-size: 14px;
      }

      /* upload image */
      .uploaded-img {
        border-radius: 50%;
        max-width: 150px; /* Adjust as needed */
        height: auto;
        margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <div class="profile-container">
      <h2>Profile Settings</h2>
      <div class="text-center mt-4">
        <img src={{ asset('img/profilemark.jpg') }} alt="Profile Image" class="profile-img" />
      </div>

      <!-- Image Upload Section -->
      <div class="text-center mt-3">
        <div class="upload-btn-wrapper">
          <button class="btn-upload">Upload Image</button>
          <input type="file" name="myfile" />
        </div>
      </div>

      <!-- Edit Profile Form -->
      <form class="edit-form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter your username" />
        </div>

        <div class="form-group position-relative">
          <label for="password">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" placeholder="Enter your password" />
          </div>
        </div>

        <!-- New Password Section -->
        <div class="form-group position-relative">
          <label for="newPassword">New Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="newPassword" placeholder="Enter your new password" />
          </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
          <button class="btn btn-primary btn-save" onclick="showAlert()">Simpan</button>
        </div>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
