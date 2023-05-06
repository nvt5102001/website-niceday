<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Đăng nhập trang quản lý</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <link rel="shortcut icon" type="image/x-icon" href="../admin/images/favicon.png">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="../admin/css/main.css">
</head>

<body>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      min-height: 100vh;
      font-family: 'Roboto', sans-serif;
      background: #fff;
    }
  </style>
  <?php
  session_start();
  include('config/config.php');
  if (isset($_POST['dangnhap'])) {
    $Gmail = $_POST['Gmail'];
    $MatKhau = md5($_POST['MatKhau']);
    $sql = "SELECT * FROM tblaccount WHERE Gmail='" . $Gmail . "' AND Password='" . $MatKhau . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if ($count > 0) {
      $row_data = mysqli_fetch_array($row);
      if ($row_data['AccessPermissions'] == '0') {
        $_SESSION['TenTK'] = $row_data['AccountName'];
        $_SESSION['dangnhap'] = $Gmail;
        header("Location:index.php");
      } else {
        echo "<script>alert('Tài khoản này không có quyền truy cập.');</script>";
        echo "<script>window.location = 'login.php';</script>";
        exit();
      }
    } else {
      echo "<script>alert('Mật khẩu hoặc Email sai ,vui lòng nhập lại.');</script>";
      echo "<script>window.location = 'login.php';</script>";
      exit();
    }
  }
  ?>

  <div class="form-container">
    <div class="form-inner-left">
      <div class="left-content">
        <h2>Welcome Back!</h2>
        <p>Đăng nhập tài khoản admin để có thể vào Dashboard.</p>
      </div>
    </div>
    <div class="form-inner-right">
      <div class="form-inner">
        <h3>Login</h3>

        <form class="form" action="" autocomplete="off" method="POST">
          <div class="group-input">
            <input type="email" name="Gmail" class="input-box gray-border" placeholder="youremail@gmail.com" required>
          </div>
          <div class="group-input">
            <input type="password" name="MatKhau" class="input-box gray-border" placeholder="Password" id="password-input">
            <i class="fa fa-eye" aria-hidden="true" id="showPassword" minlength="6" onclick="showPassword()"></i>
          </div>
          <button class="input-box green-bg green-border" name="dangnhap" type="submit">Log In</button>
        </form>
      </div>
    </div>
  </div>
  <script>
    function showPassword() {
      var x = document.getElementById("password-input");
      var icon = document.getElementById("showPassword");
      if (x.type === "password") {
        x.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        x.type = "password";
        icon.classList.add('fa-eye');
        icon.classList.remove('fa-eye-slash');
      }
    }
  </script>
</body>

</html>