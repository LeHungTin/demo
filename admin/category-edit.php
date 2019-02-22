<?php include 'header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sửa danh mục
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <?php 

          $id = isset($_GET['id']) ? $_GET['id'] : 0;

          $query = mysqli_query($conn,"SELECT * FROM category WHERE id = $id");

          $cat = mysqli_fetch_assoc($query);

          // echo '<pre>';
          // print_r($cat);
          // echo '</pre>';

            if (isset($_POST['name'])) {
              $name = $_POST['name'];
              $status = $_POST['status'];

              $sql = "UPDATE category SET name = '$name', status = '$status' WHERE id = $id";

              if (mysqli_query($conn,$sql)) {
                header('location: category.php');
              }else{
                echo "Có lỗi thêm mới";
              }
            }

          ?>
          <form action="" method="POST" class="form-inline" role="form">
            <div class="form-group">
              <input class="form-control" name="name" placeholder="Tên danh mục.." value="<?php echo $cat['name'];?>">
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="status"  value="1" <?php if($cat['status'] == 1) echo 'checked';?>>
                  Hiển thị
                </label>
                <label>
                  <input type="radio" name="status"  value="0" <?php if($cat['status'] == 0) echo 'checked';?>>
                  Ẩn
                </label>
              </div>
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