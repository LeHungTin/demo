<?php include 'header.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Sửa tin tức
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

        $query = mysqli_query($conn,"SELECT * FROM post WHERE id = $id");
        $post = mysqli_fetch_assoc($query);
        


          // upload anh và lấy tên ảnh

        $image = $post['image'];

        if (!empty($_FILES['image']['name'])) {
          $f = $_FILES['image'];
          $f_name = time().'-'.$f['name'];

          if (move_uploaded_file($f['tmp_name'], '../uploads/'.$f_name)) {
            $image = $f_name;
          }

        }

        if (isset($_POST['name'])) {
         $name = $_POST['name'];  
         $description = $_POST['description'];
         $content = $_POST['content'];
         $status = $_POST['status'];

         $sql = mysqli_query($conn, "UPDATE post SET name = '$name',content = '$content',description = '$description',image = '$image',status = '$status' WHERE id = $id");

         if ($sql) {

          header('location: post.php');
        }else{
          echo "Có lỗi sửa";
        }
      }

      ?>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Tên tin tức</label>
          <input class="form-control" name="name" placeholder="Tên sản phẩm.." value="<?php echo $post['name'] ?>">
        </div>
        <div class="form-group">

          <label for="">Ảnh</label>
          <img src="../uploads/<?php echo $post['image'] ?>" alt="" style = "max-height: 100px;max-width: 100px;margin-bottom: 5px;">
          <input type="file" name="image" >
        </div>
        <div class="row">
          
        </div>
        <div class="row">
          
          <div class="col-md-4"></div>
          
        </div>
        <div class="row">
          
          
        </div>
        <div class="form-group">
          <label for="">Mô tả</label>
          <input type="textarea" name="description" value="<?php echo $post['description'] ?>" class="form-control" rows="3" placeholder="Nhập nội dung mô tả" >
        </div>
        <div class="form-group">
          <label for="">Nội dung</label>
         <input type="textarea" name="content" value="<?php echo $post['content'] ?>" class="form-control" rows="3" placeholder="Nhập nội dung mô tả" >
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