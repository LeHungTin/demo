<?php include 'header.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Sửa sản phẩm
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <?php 
        // lấy id mục đã chọn

        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        $query = mysqli_query($conn,"SELECT * FROM product WHERE id = $id");
        $query2 = mysqli_query($conn,"SELECT * FROM product_image WHERE product_id = $id");
        $pro = mysqli_fetch_assoc($query);
        $pro_img = mysqli_fetch_assoc($query2);

        // lay tat ca attibutes

        $attr = mysqli_query($conn,"SELECT * FROM product_attribute WHERE product_id = $id");
        $check_attr = mysqli_num_rows($attr);
        $attr_arrs = [];

        if ($check_attr) {
          foreach ($attr as $atr) {
            $attr_arrs[] = $atr['attribute_id'];
          }
        }

          // upload anh và lấy tên ảnh

        $image = $pro['image'];

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
          
          $sql = mysqli_query($conn, "UPDATE product SET name = '$name',category_id ='$category_id',price = '$price',sale_price = '$sale_price',description = '$description',image = '$image',status = '$status' WHERE id = $id");

          if ($sql) {

            // Xóa thuộc tính của sản phẩm nếu đang có

           if ($check_attr >= 1) {
            $delete_attr = mysqli_query($conn,"DELETE FROM product_attribute WHERE product_id = $id");
            
          }

          if (count($sizesss) > 0) {

            foreach ($sizesss as $ss) {
              mysqli_query($conn,"INSERT INTO product_attribute VALUES($id,$ss)");
            }
          }

          if (count($colorss) > 0) {
            foreach ($colorss as $cls) {
              mysqli_query($conn,"INSERT INTO product_attribute VALUES($id,$cls)");
            }
          }

            // update nhiều ảnh

          if (!empty($_FILES['anh_khac']['name'][0])) {

            mysqli_query($conn,"DELETE FROM product_image WHERE product_id = $id");
            $n = count($_FILES['anh_khac']['name']);
            $f = $_FILES['anh_khac'];
            
            for ($i = 0; $i < $n; $i++) {

              $f_name = time().'-'.$f['name'][$i];

              if (move_uploaded_file($f['tmp_name'][$i], '../uploads/'.$f_name)) {
                mysqli_query($conn,"INSERT INTO product_image(link_img,product_id) VALUES ('$f_name',$id)");
              }

            }
          }

          header('location: product.php');
        }else{
          echo "Có lỗi sửa";
        }
      }

      ?>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Tên sản phẩm</label>
          <input class="form-control" name="name" placeholder="Tên sản phẩm.." value="<?php echo $pro['name'] ?>">
        </div>
        <div class="form-group">

          <label for="">Ảnh</label>
          <img src="../uploads/<?php echo $pro['image'] ?>" alt="" style = "max-height: 100px;max-width: 100px;margin-bottom: 5px;">
          <input type="file" name="image" >
        </div>
        <div class="row">
          <div class="form-group">

            <label for="">Chọn ảnh khác</label>
            <input type="file" name="anh_khac[]" multiple>
            <?php foreach ($query2 as $q2) : ?>

              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

                <img src="../uploads/<?php echo$q2['link_img'] ?>" alt="" style = "max-height: 100px;max-width: 100px;margin-top: 5px;">


              </div>
            <?php endforeach ?>
          </div>
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
                <?php foreach($cats as $c) : 
                  $selected = $pro['category_id'] == $c['id'] ? 'selected' : '';
                  ?>
                  <option value="<?php echo $c['id'] ?>" <?php echo $selected; ?>><?php echo $c['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Giá</label>
              <input class="form-control" name="price" placeholder="Giá.." value="<?php echo $pro['price'] ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Giá khuyến mãi</label>
              <input class="form-control" name="sale_price" placeholder="Giá khuyến mãi.." value="<?php echo $pro['sale_price'] ?>">
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
              <?php foreach($sizes as $s) : 
                $checked = in_array($s['id'], $attr_arrs) ? 'checked' : '';
                ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="size[]" value="<?php echo $s['id'];?>" <?php echo $checked; ?>>
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
              <?php foreach($colors as $cl) : 
                $checked1 = in_array($cl['id'], $attr_arrs) ? 'checked' : '';
                ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="color[]" value="<?php echo $cl['id'];?>" <?php echo $checked1; ?>>
                    <!--  <?php echo $cl['name'];?> -->
                    <div style="background: <?php echo $cl['value'];?>;display: inline-block;width: 20px;height: 20px;border-radius: 100%"></div>
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