<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sửa tài khoản quản trị
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <?php 

        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        $query = mysqli_query($conn,"SELECT * FROM users WHERE id = $id");

        $user = mysqli_fetch_assoc($query);

          // echo '<pre>';
          // print_r($cat);
          // echo '</pre>';
        $errors = [];
        if (isset($_POST['name'])) {
          $name = $_POST['name'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $new_password = $_POST['new_password'];
          $confirm_new_password = $_POST['confirm_new_password'];

          if ($password == '') {
            $errors['password'] = 'Mật khẩu cũ không được để trống';
            
          }

          if (md5(md5($password)) != $user['password']) {
            $errors['password'] = 'Mật khẩu cũ không đúng';
            
          }
          if ($new_password == '') {
            $errors['new_password'] = 'Mật khẩu mới không được để trống';
            
          }
          if ($new_password != $confirm_new_password) {
            $errors['confirm_new_password'] = 'Mật khẩu không trùng';
            
          }
          if (!$errors) {
            $check_password = md5(md5($new_password));
            $sql = "UPDATE users SET name = '$name', phone = '$phone', email = '$email', password = '$check_password' WHERE id = $id";

            if (mysqli_query($conn,$sql)) {
              header('location: admin.php');
            }
          }
          else{
            echo 'có lỗi sửa!';
          }
        }

        ?>
        <form action="" method="POST" role="form">

         <div class="form-group">
          <label for="">Name</label>
          <input required="" type="text" class="form-control" name="name" value="<?php echo $user['name'] ?>" id="" placeholder="Name">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input required="" type="email" class="form-control" name="email" value="<?php echo $user['email'] ?>" id="" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="">Phone</label>
          <input required="" type="text" class="form-control" name="phone" value="<?php echo $user['phone'] ?>" id="" placeholder="Phone">
        </div>
        <div class="form-group <?php if (isset($errors['password'])) : ?> has-error <?php endif; ?>">
          <label for="">Password</label>
          <input required="" type="password" class="form-control" name="password" id="" placeholder="Password">
          <?php if (isset($errors['password'])) : ?>
            <div class="help-block">
              <?php echo $errors['password']; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="form-group <?php if (isset($errors['new_password'])) : ?> has-error <?php endif; ?>">
          <label for="">New Password</label>
          <input required="" type="password" class="form-control" name="new_password" id="" placeholder="New Password">
          <?php if (isset($errors['new_password'])) : ?>
            <div class="help-block">
              <?php echo $errors['new_password']; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="form-group <?php if (isset($errors['confirm_new_password'])) : ?> has-error <?php endif; ?>">
          <label for="">Confirm New Password</label>
          <input required="" type="password" class="form-control" name="confirm_new_password" id="" placeholder="Confirm New Password">
          <?php if (isset($errors['confirm_new_password'])) : ?>
            <div class="help-block">
              <?php echo $errors['confirm_new_password']; ?>
            </div>
          <?php endif; ?>
        </div>


        <button type="submit" class="btn btn-primary">Sửa</button>
      </form>
    </div>
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>