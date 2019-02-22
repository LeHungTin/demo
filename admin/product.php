<?php include 'header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        QL sản phẩm
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php 
      $sql  = "SELECT p.*,c.name as 'cat_name' FROM product p JOIN category c ON p.category_id = c.id";
      $products = mysqli_query($conn,$sql);

      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
           <form action="" method="POST" class="form-inline" role="form">
            <div class="form-group">
              <input class="form-control" name="search_name" placeholder="Nhập tên tìm kiếm...">
            </div>
            <button type="submit" class="btn btn-primary">Tìm</button>
            <a href="product-add.php" class="btn btn-success">Thêm mới</a>
          </form>
        </div>
        <div class="box-body">
         
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($products as $pro) { ?>
              <tr>
                <td><?php echo $pro['id'] ?></td>
                <td>
                  <img src="../uploads/<?php echo $pro['image'] ?>" alt="" width="50">
                </td>
                <td><?php echo $pro['name'] ?></td>
                <td><?php echo $pro['cat_name'] ?></td>
                <td>
                <?php if($pro['status'] == 1) : ?>
                  <span>Hiển thị</span>
                <?php else: ?>
                   <span>Ẩn</span>
                <?php endif; ?>
                </td>
                <td>
                  <?php echo date('d-m-Y',strtotime($pro['created_at'])) ?>
                </td>
                <td>
                  <a href="product-edit.php?id=<?php echo $pro['id']; ?>" class="btn btn-xs btn-success">Sửa</a>
                  <a href="product-delete.php?id=<?php echo $pro['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('bạn có chắc không')">Xóa</a>
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