<?php include 'header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thêm mới sản phẩm
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <?php 
          // upload anh và lấy tên ảnh

          $image = '';

          if (!empty($_FILES['image']['name'])) {
            $f = $_FILES['image'];
            $f_name = time().'-'.$f['name'];

            if (move_uploaded_file($f['tmp_name'], '../uploads/'.$f_name)) {
              $image = $f_name;
            }
            // die;
          }


            if (isset($_POST['name'])) {
              $name = $_POST['name'];
              $category_id = $_POST['category_id'];
              $price = $_POST['price'];
              $sale_price = $_POST['sale_price'];
              $description = $_POST['description'];
              $status = $_POST['status'];

              $sizesss = $_POST['size'];
              $colorss = $_POST['color'];
              // echo '<pre>';
              //   print_r($sizesss);
              //   print_r($colorss);
              // echo '</pre>';
              $sql = "INSERT INTO product(name,category_id,price,sale_price,description,image,status) VALUES('$name','$category_id','$price','$sale_price','$description','$image','$status')";

              if (mysqli_query($conn,$sql)) {
                // lấy id của sp vừa lưu
                $product_id = mysqli_insert_id($conn);


                // lưu vào bảng product-attribute nếu có chọn
                if (count($sizesss) > 0) {
                  foreach ($sizesss as $ss) {
                    mysqli_query($conn,"INSERT INTO product_attribute VALUES($product_id,$ss)");
                  }
                }

                // lưu vào bảng product-attribute nếu có chọn
                if (count($colorss) > 0) {
                  foreach ($colorss as $cls) {
                    mysqli_query($conn,"INSERT INTO product_attribute VALUES($product_id,$cls)");
                  }
                }


                 // upload nhiều ảnh
      
              if (!empty($_FILES['anh_khac']['name']) && count($_FILES['anh_khac']['name']) > 0) {
                $n = count($_FILES['anh_khac']['name']);
                  $f = $_FILES['anh_khac'];
                  
                for ($i = 0; $i < $n; $i++) {

                  $f_name = time().'-'.$f['name'][$i];
                  if (move_uploaded_file($f['tmp_name'][$i], '../uploads/'.$f_name)) {
                    mysqli_query($conn,"INSERT INTO product_image(link_img,product_id) VALUES('$f_name',$product_id)");
                  }

                }

                // die;
              }

                header('location: product.php');
              }else{
                echo "Có lỗi thêm mới";
              }
            }

          ?>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Tên sản phẩm</label>
              <input class="form-control" name="name" placeholder="Tên sản phẩm..">
            </div>
            <div class="form-group">
              <label for="">Ảnh đại diện</label>
              <input type="file" name="image" >
            </div>
            <div class="form-group">
              <label for="">Các ảnh khác</label>
              <input type="file" name="anh_khac[]" multiple>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <?php 
                $cats = mysqli_query($conn,"SELECT * FROM category");

                ?>
                  <label for="">Danh mục</label>
                  <select name="category_id" class="form-control" required="required">
                    <option value="">Chọn danh mục</option>
                  <?php foreach($cats as $c) : ?>
                    <option value="<?php echo $c['id'] ?>"><?php echo $c['name'] ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Giá</label>
                  <input class="form-control" name="price" placeholder="Giá..">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Giá khuyến mãi</label>
                  <input class="form-control" name="sale_price" placeholder="Giá khuyến mãi..">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <?php 
                $sizes = mysqli_query($conn,"SELECT * FROM attributes WHERE type = 'size'");
                ?>
                  <label for="">Kích thước</label>
                  <?php foreach($sizes as $s) : ?>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="size[]" value="<?php echo $s['id'];?>">
                      <?php echo $s['name'];?>
                    </label>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                <?php 
                $colors = mysqli_query($conn,"SELECT * FROM attributes WHERE type = 'color'");
                ?>
                  <label for="">Màu sắc</label>
                  <?php foreach($colors as $cl) : ?>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="color[]" value="<?php echo $cl['id'];?>">
                      <?php echo $cl['name'];?>
                    </label>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class="form-group">
                  <label for="">Mô tả</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Nhập nội dung mô tả"></textarea>
            </div>
            <div class="form-group">
              <label for="">Trạng thái</label>
              <div class="radio">
                <label>
                  <input type="radio" name="status"  value="1" checked>
                  Hiển thị
                </label>
                <label>
                  <input type="radio" name="status"  value="0">
                  Ẩn
                </label>
              </div>
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