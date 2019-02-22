<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Thêm mới quản trị viên
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-body">

        <?php 

        $errors = [];
        if (isset($_POST['name'])) {
          $name = $_POST['name'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $confirm_password = $_POST['confirm_password'];

          if ($password != $confirm_password) {
            $errors['confirm_password'] = 'Mật khẩu không trùng!';

          }

          if (!$errors) {
            $check_password = md5(md5($password));
            $sql = mysqli_query($conn,"INSERT INTO users(name,phone,email,password,group_name) VALUES('$name','$phone','$email','$check_password','admin')");
            if ($sql) {
              header('location: admin.php');
              
            }else{
              echo '<div class="alert alert-warning">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Thêm mới thất bại!</strong>
              </div>';

            }
            
          }



        }

        ?>
        <form action="" method="POST" role="form">


          <div class="form-group">
            <label for="">Name</label>
            <input required="" type="text" class="form-control" name="name" id="" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input required="" type="email" class="form-control" name="email" id="" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="">Phone</label>
            <input required="" type="text" class="form-control" name="phone" id="" placeholder="Phone">
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input required="" type="password" class="form-control" name="password" id="" placeholder="Password">
          </div>
          <div class="form-group <?php if (isset($errors['confirm_password'])) : ?> has-error <?php endif; ?>">
            <label for="">Confirm Password</label>
            <input required="" type="password" class="form-control" name="confirm_password" id="" placeholder="Confirm Password">

            <?php if (isset($errors['confirm_password'])) : ?>
              <div class="help-block">
                <?php echo $errors['confirm_password']; ?>
              </div>
            <?php endif; ?>
            
          </div>



          <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
      </div>
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>