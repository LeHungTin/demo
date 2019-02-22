<?php 
session_start();
ob_start();
include '../global/connect.php';

if (!isset($_SESSION['admin_login'])) {

  header('location: admin_login.php');
  
}else{
  $admin = $_SESSION['admin_login'];

}

?>

<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content">


    <!-- Default box -->
    <div class="box">
      <div class="box-header">
       
      </div>
      <div class="box-body">

        <h3>Khách hàng mới</h3>
        <?php 
        $user = mysqli_query($conn,"SELECT * FROM users WHERE group_name = 'customer' ORDER BY id DESC LIMIT 5");
        ?>
        <div class="box">
          
          <div class="box-body">
           
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Ngày tạo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($user as $u) { ?>
                  <tr>
                    <td><?php echo $u['id'] ?></td>
                    <td><?php echo $u['name'] ?></td>
                    <td><?php echo $u['email'] ?></td>
                    <td><?php echo $u['phone'] ?></td>
                    <td><?php echo $u['created_at'] ?></td>
                    
                    <td>
                     
                      <a href="customer-delete.php?id=<?php echo $u['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('bạn có chắc không')">Xóa</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <h3>Đơn hàng mới</h3>
        <section class="content">
          <?php 
          $sqlJoin = "SELECT od.id,od.status,od.created_at,SUM(dt.price*dt.quantity) AS 'total' FROM orders od JOIN order_detail dt ON od.id = dt.order_id GROUP BY od.id,od.status,od.created_at ORDER BY od.id DESC LIMIT 5";
          $orders = mysqli_query($conn,$sqlJoin);

          ?>
          <!-- Default box -->
          <div class="box">

            <div class="box-body">

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
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
                      <td><?php echo $ods['id'] ?></td>
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
          </div>
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include 'footer.php'; ?>