<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  </head>
  <body style="background-color: #242564">
    <div class="container mt-5">
      <!-- Logo -->
      <div class="text-center mb-3">
        <img src="{{ asset('img/SIANO_logo.png') }}" alt="SIANO Logo" style="max-width: 250px; height: auto" />
      </div>

      <div class="card" style="max-width: 400px; margin: auto; background-color: #ffffff; border-radius: 15px; padding: 20px">
        <h2 class="card-title text-center text-dark">Change Password</h2>
        <form>
          <div class="form-group">
            <label for="email" class="text-dark">New Password:</label>
            <input type="email" class="form-control" id="email" name="email" required />
          </div>
          <div class="form-group">
            <label for="password" class="text-dark">Confirm Password:</label>
            <input type="password" class="form-control" id="password" name="password" />
          </div>

          <div class="d-flex justify-content-center">
            <button class="btn btn-primary mr-2 mt-3" style="height: 38px; line-height: 20px; border-radius: 10px" onclick="backConfirm()">
              <i class="fa-solid fa-arrow-left" style="color: #ffffff; font-size: 18px"></i>
            </button>
            <button type="submit" class="btn btn-warning btn-block mt-3" style="border-radius: 10px" onclick="submit_reset()">Reset</button>
          </div>
        </form>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>
      function submit_reset() {
        console.log("Logout function called");
        window.location.href = "login";
      }

      function backConfirm() {
        console.log("backComfirm function called");
        window.location.href = "confirm_email.html";
      }
    </script>
  </body>
</html>
