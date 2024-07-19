<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  </head>
  <body style="background-color: #242564">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <!-- SIANO Logo -->
          <div class="text-center mb-3">
            <img src="{{ asset('img/SIANO_logo.png') }}" alt="SIANO Logo" style="max-width: 250px; height: auto" />
          </div>

          <!-- Vokasi Logo and Form -->
          <div class="card" style="background-color: #ffffff; border-radius: 15px; padding: 20px">
            <div class="row">
              <div class="col-md-4 text-center mb-3 mt-5">
                <!-- Vokasi Logo -->
                <img src="{{ asset('img/logovokasi.png') }}" alt="Vokasi Logo" style="max-width: 170px; height: auto" />
              </div>
              <div class="col-md-8">
                <!-- Input Fields -->
                <h2 class="card-title text-center text-dark">Login</h2>
                <form action="" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="email" class="text-dark">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Email" />
                  </div>
                  <div class="form-group">
                    <label for="password" class="text-dark">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Password" />
                  </div>
                  <div class="form-group text-right">
                    <a href="forgotpw.html" style="color: #007bff"></a>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning btn-block mt-3" style="border-radius: 10px">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
