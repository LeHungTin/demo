<?php include 'header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
<?php 

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if (mysqli_query($conn,"DELETE FROM attributes WHERE id=$id")) {
  header('location: product-attr.php');
}else{ ?>
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lỗi xóa danh mục
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          Danh mục bạn xóa không có hoặc danh mục này đang có sản phẩm
        </div>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

<?php } ?>
<?php include 'footer.php'; ?>