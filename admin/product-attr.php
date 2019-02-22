<?php include 'header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        QL thuộc tính
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php 
      $attributes = mysqli_query($conn,"SELECT * FROM attributes");

      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
           <form action="" method="POST" class="form-inline" role="form">
            <div class="form-group">
              <input class="form-control" name="search_name" placeholder="Nhập tên tìm kiếm...">
            </div>
            <button type="submit" class="btn btn-primary">Tìm</button>
            <a href="attribute-add.php" class="btn btn-success">Thêm mới</a>
          </form>
        </div>
        <div class="box-body">
         
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Tên thuộc tính</th>
                <th>Giá trị</th>
                <th>Kiểu</th>
                <th>Ngày tạo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($attributes as $attr) { ?>
              <tr>
                <td><?php echo $attr['id'] ?></td>
                <td><?php echo $attr['name'] ?></td>
                <td>
                  <?php if($attr['type'] == 'color') : ?>
                    <span style="background: <?php echo $attr['value'];?>;display: inline-block;width: 20px;height: 20px;border-radius: 100%"></span>
                  <?php else: ?>
                        <?php echo $attr['value'];?>
                  <?php endif; ?>
                </td>
                <td>
                 <?php echo $attr['type']; ?>
                </td>
                <td>
                  <?php echo date('d-m-Y',strtotime($attr['created_at'])) ?>
                </td>
                <td>
                  <a href="attribute-edit.php?id=<?php echo $attr['id']; ?>" class="btn btn-xs btn-success">Sửa</a>
                  <a href="attribute-delete.php?id=<?php echo $attr['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('bạn có chắc không?')">Xóa</a>
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