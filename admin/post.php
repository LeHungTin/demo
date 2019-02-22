<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      QL Tin tức
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php 
    $sql  = "SELECT * FROM post";
    $posts = mysqli_query($conn,$sql);

    ?>
    <!-- Default box -->
    <div class="box">
      <div class="box-header">
       <form action="" method="POST" class="form-inline" role="form">
        <div class="form-group">
          <input class="form-control" name="search_name" placeholder="Nhập tên tìm kiếm...">
        </div>
        <button type="submit" class="btn btn-primary">Tìm</button>
        <a href="post-add.php" class="btn btn-success">Thêm mới</a>
      </form>
    </div>
    <div class="box-body">

      <table class="table table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Ảnh</th>
            <th>Tên tin tức</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($posts as $ps) { ?>
            <tr>
              <td><?php echo $ps['id'] ?></td>
              <td>
                <img src="../uploads/<?php echo $ps['image'] ?>" alt="" width="50">
              </td>
              <td><?php echo $ps['name'] ?></td>
              <td style="max-width: 400px;"><?php echo $ps['description'] ?></td>
              <td>
                <?php if($ps['status'] == 1) : ?>
                  <span>Hiển thị</span>
                  <?php else: ?>
                   <span>Ẩn</span>
                 <?php endif; ?>
               </td>
               <td>
                <?php echo date('d-m-Y',strtotime($ps['created_at'])) ?>
              </td>
              <td>
                <a href="post-edit.php?id=<?php echo $ps['id']; ?>" class="btn btn-xs btn-success">Sửa</a>
                <a href="post-delete.php?id=<?php echo $ps['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('bạn có chắc không')">Xóa</a>
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