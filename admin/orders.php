<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      QL đơn hàng
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php 
    $sqlJoin = "SELECT od.id,od.status,od.created_at,u.name AS 'user_name',u.email AS 'user_email',SUM(dt.price*dt.quantity) AS 'total' FROM orders od JOIN users u ON od.user_id = u.id JOIN order_detail dt ON od.id = dt.order_id GROUP BY od.id,od.status,od.created_at";
    $orders = mysqli_query($conn,$sqlJoin);

    ?>
    <!-- Default box -->
    <div class="box">

      <div class="box-body">

        <table class="table table-hover">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên khách hàng</th>
              <th>Email</th>
              <th>Ngày tạo</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $k => $ods) { ?>
              <tr>
                <td><?php echo $k+1; ?></td>
                <td><?php echo $ods['user_name'] ?></td>
                <td><?php echo $ods['user_email'] ?></td>
                <td><?php echo $ods['created_at'] ?></td>
                <td><?php echo number_format($ods['total']) ?></td>
                <td>
                  <?php if ($ods['status'] == 2): ?>
                    <span class="label label-primary">Đã giao hàng</span>

                    <?php elseif ($ods['status'] == 1): ?>
                      <span class="label label-success">Đã duyệt</span>

                      <?php else: ?>
                        <span class="label label-danger">Chưa duyệt</span>

                      <?php endif ?>
                      

                    </td>
                    
                    <td>
                      <a href="order-detail.php?id=<?php echo $ods['id']; ?>" class="btn btn-xs btn-success">Xem</a>

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