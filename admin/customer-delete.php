<?php include 'header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
<?php 

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if (mysqli_query($conn,"DELETE FROM users WHERE id=$id")) {
  header('location: customer.php');
}else{ ?>
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lỗi xóa tài khoản khách hàng
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
         Tài khoản khách hàng không có
        </div>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

<?php } ?>
<?php include 'footer.php'; ?>