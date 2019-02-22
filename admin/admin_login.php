<?php 
session_start();
ob_start();
include '../global/connect.php';

 ?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<?php 
$errors = [];
if (isset($_POST['login_admin'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $check_email = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
  if (mysqli_num_rows($check_email) == 1) {
    $admin = mysqli_fetch_assoc($check_email);
    $check_password = md5(md5($password));

    if ($check_password == $admin['password']) {
      $_SESSION['admin_login'] = $admin;
      header('location: index.php');
      
    }else {
      $errors['password'] = 'Mật khẩu không đúng!';
    }

    
  }else {
    $errors['email'] = 'Email này không tồn tại!';
  }
  
}

 ?>

<html>
  <head>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="public/css/login_admin.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  </head>
<body id="LoginForm">
<div class="container">
<h1 class="form-heading">login Form</h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Login</h2>
   <p>Please enter your email and password</p>
   </div>
    <form id="Login" action="" method="POST">

        <div class="form-group">


            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email Address">
            <?php if (isset($errors['email'])): ?>
              <div class="help-block">
                <?php echo $errors['email']; ?>
              </div>
              
            <?php endif ?>

        </div>

        <div class="form-group">

            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
            <?php if (isset($errors['password'])): ?>

              <?php echo $errors['password']; ?>
              
            <?php endif ?>

        </div>
        <div class="forgot">
        <a href="reset.html">Forgot password?</a>
</div>
        <button type="submit" name="login_admin" class="btn btn-primary">Login</button>

    </form>
    </div>
<p class="botto-text"> Designed by Lê Hùng Tín</p>
</div></div></div>


</body>
</html>
