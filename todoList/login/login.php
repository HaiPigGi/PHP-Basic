<?php
session_start();
require '../database/database.php';
// Inisialisasi variabel error dan pesan
$error = "";
$message = "";
// Cek apakah tombol login sudah ditekan
if (isset($_POST["login"])) {
    // Ambil username dan password dari form login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk mencari user di database
    $query = mysqli_query($conn, "SELECT * FROM users WHERE user_name = '$username'");

    // Cek apakah user ditemukan
    if (mysqli_num_rows($query) == 1) {
        $cek = mysqli_fetch_assoc($query);
        // Cek apakah password cocok
        if (password_verify($password, $cek["password"])) {
            // Login sukses, redirect ke halaman to do list
            $_SESSION["login"]=true;
            $_SESSION["id"] = $cek["ID"];
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "User tidak ditemukan. Silahkan Lakukan Register Terlebih Dahulu.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>Login</title>
</head>
<body>
    <?php if ($error != ""): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($message != ""): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">

        <form method="POST" name="loginForm" onsubmit="return validateForm()">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="text" id="username" class="form-control form-control-lg" name="username"/>
                <label class="form-label" for="username">Username</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                <label class="form-label" for="password">Password</label>
              </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit" name="login">Login</button>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Register</a>
              </p>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>   

<script>
  function validateForm() {
    var username = document.forms["loginForm"]["username"].value;
    var password = document.forms["loginForm"]["password"].value;
    if (username == "" || password == "") {
      alert("Silahkan Melakukan Input Data Terlebih Dahulu");
      return false;
    }
  }
</script>
</body>
</html>
