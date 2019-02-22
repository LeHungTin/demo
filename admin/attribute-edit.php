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

          $query = mysqli_query($conn,"SELECT * FROM attributes WHERE id = $id");

          $attr = mysqli_fetch_assoc($query);

          // echo '<pre>';
          // print_r($attr);
          // echo '</pre>';

            if (isset($_POST['name'])) {
              $name = $_POST['name'];
              $value = $_POST['value'];

              $sql = "UPDATE attributes SET name = '$name', value = '$value' WHERE id = $id";

              if (mysqli_query($conn,$sql)) {
                header('location: product-attr.php');
              }else{
                echo "Có lỗi thêm mới";
              }
            }

          ?>
          <form action="" method="POST" class="form-inline" role="form">
            <div class="form-group">
              <input class="form-control" name="name" placeholder="Tên danh mục.." value="<?php echo $attr['name'];?>">
            </div>
             <div class="form-group">
              <input class="form-control" name="value" placeholder="Giá trị.." value="<?php echo $attr['value'];?>">
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="type"  value="1" <?php if($attr['type'] == 'color') echo 'checked';?>>
                  Color
                </label>
                <label>
                  <input type="radio" name="type"  value="0" <?php if($attr['type'] == 'size') echo 'checked';?>>
                  Size
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