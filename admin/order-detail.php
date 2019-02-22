<?php include 'header.php'; ?>
<?php $order_id = isset($_GET['id']) ? $_GET['id'] : 0; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Chi tiết đơn hàng
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="container">
        <div class="row">
          <?php 
          $sqlJoin2 = "SELECT od.id,od.status,od.created_at,u.name AS 'user_name',u.email AS 'user_email', u.phone AS 'user_phone', u.address AS 'user_address',SUM(dt.price*dt.quantity) AS 'total' FROM orders od JOIN users u ON od.user_id = u.id JOIN order_detail dt ON od.id = dt.order_id WHERE od.id = $order_id";
          $qr = mysqli_query($conn,$sqlJoin2);
          $orders = mysqli_fetch_assoc($qr);


          ?>
          <div class="col-md-6">
           <table class="table table-hover">
            <h3>Thông tin đơn hàng</h3>
            <tr>
             <th>Id</th>
             <td><?php echo $orders['id']; ?></td>
           </tr>
           <tr>
             <th>Ngày tạo</th>
             <td><?php echo $orders['created_at']; ?></td>
           </tr>
           <tr>
             <th>Tổng tiền</th>
             <td><?php echo number_format($orders['total']); ?></td>
           </tr>
           <tr>
             <th>Trạng thái</th>
             <td>
               <?php if ($orders['status'] == 2): ?>
                <span class="label label-primary">Đã giao hàng</span>

                <?php elseif($orders['status'] == 1): ?>
                <span class="label label-success">Đã duyệt</span>
                <a class="label label-danger" href="order-status.php?id=<?php echo $orders['id'] ?>&status=0">Bỏ duyệt</a>
                <a class="label label-primary" href="order-status.php?id=<?php echo $orders['id'] ?>&status=2">Giao hàng</a>
                <?php else: ?>
                  <span class="label label-danger">Chưa duyệt</span>
                  <a class="label label-success" href="order-status.php?id=<?php echo $orders['id'] ?>&status=1">Duyệt</a>

                 
               <?php endif ?>
             </td>
             
           </tr>
         </table>
       </div>
       <div class="col-md-6">
         <table class="table table-hover">
          <h3>Thông tin người dùng</h3>
          <tr>
           <th>Tên</th>
           <td><?php echo $orders['user_name']; ?></td>
         </tr>
         <tr>
           <th>Email</th>
           <td><?php echo $orders['user_email']; ?></td>
         </tr>
         <tr>
           <th>Số điện thoại</th>
           <td><?php echo $orders['user_phone']; ?></td>
         </tr>
         <tr>
           <th>Địa chỉ</th>
           <td><?php echo $orders['user_address']; ?></td>
         </tr>
       </table>
     </div>
   </div>
   <div class="row">

    <?php 
    $sqlJoin = "SELECT dt.order_id,dt.quantity,dt.price,pro.name AS 'product_name',pro.image AS 'product_image' FROM order_detail dt JOIN product pro ON dt.product_id = pro.id WHERE dt.order_id = $order_id";
    $order_detail = mysqli_query($conn,$sqlJoin);

    ?>
    <div class="box-body">
     <h3>Chi tiết đơn hàng</h3>
     <table class="table table-hover">

      <thead>
        <tr>
          <th>STT</th>

          <th>Tên sản phẩm</th>
          <th>Ảnh</th>
          <th>Số lượng</th>
          <th>Giá</th>

          <!-- <th></th> -->
        </tr>
      </thead>
      <tbody>
        <?php foreach($order_detail as $k => $dt) { ?>
          <tr>
            <td><?php echo $k+1; ?></td>

            <td><?php echo $dt['product_name'] ?></td>
            <td><img style="width: 50px;" src="../uploads/<?php echo $dt['product_image'] ?>"></td>
            <td><?php echo $dt['quantity'] ?></td>
            <td><?php echo number_format($dt['price']) ?></td>


                <!-- <td>
                  <a href="order-detail.php?id=<?php echo $ods['id']; ?>" class="btn btn-xs btn-success">Xem</a>
                  
                </td> -->
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>


</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>