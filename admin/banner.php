<?php include 'header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        QL banners
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php 
      $banners = mysqli_query($conn,"SELECT * FROM banner");

      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
           <form action="" method="POST" class="form-inline" role="form">
            <div class="form-group">
              <input class="form-control" name="search_name" placeholder="Nhập tên tìm kiếm...">
            </div>
            <button type="submit" class="btn btn-primary">Tìm</button>
            <a href="banner-add.php" class="btn btn-success">Thêm mới</a>
          </form>
        </div>
        <div class="box-body">
         
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Ảnh banner</th>
                <th>Tên banner</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($banners as $bn) { ?>
              <tr>
                <td><?php echo $bn['id'] ?></td>
                <td>
                  <img src="../uploads/<?php echo $bn['link_image'] ?>" alt="" width="50">
                </td>
                <td><?php echo $bn['name'] ?></td>
                <td>
                <?php if($bn['status'] == 1) : ?>
                  <span>Hiển thị</span>
                <?php else: ?>
                   <span>Ẩn</span>
                <?php endif; ?>
                </td>
                <td>
                  <?php echo date('d-m-Y',strtotime($bn['created_at'])) ?>
                </td>
                <td>
                  <a href="banner-edit.php?id=<?php echo $bn['id']; ?>" class="btn btn-xs btn-success">Sửa</a>
                  <a href="banner-delete.php?id=<?php echo $bn['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('bạn có chắc không')">Xóa</a>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include 'footer.php'; ?>