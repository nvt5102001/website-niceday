<?php
if ($_GET['Status'] == 0) {
  $sql_lietke_pnk = "SELECT * FROM tblimport_invoice,tblaccount WHERE tblimport_invoice.SupplierAccID=tblaccount.AccountID AND tblimport_invoice.Status= 0 ORDER BY tblimport_invoice.ImInvoiceID DESC";
  $query_lietke_pnk = mysqli_query($mysqli, $sql_lietke_pnk);
} elseif ($_GET['Status'] == 1) {
  $sql_lietke_pnk = "SELECT * FROM tblimport_invoice,tblaccount WHERE tblimport_invoice.SupplierAccID=tblaccount.AccountID AND tblimport_invoice.Status= 1  ORDER BY tblimport_invoice.ImInvoiceID DESC";
  $query_lietke_pnk = mysqli_query($mysqli, $sql_lietke_pnk);
}


?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-body-header">
              <h4 class="card-title">Danh sách đơn nhập</h4>
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-plus"></i>
                <a href="index.php?action=warehouseManagement&query=insertDetail">Thêm đơn nhập </a>
              </button>
            </div>
            <div class="flex align-center">
              <div class="search-container">
                <form action="index.php?action=warehouseManagement&query=search" method="POST">
                  <input type="text" placeholder="Enter YYYY-MM-DD" name="tukhoaHD">
                  <button name="timkiemHD" type="submit">
                    <i class="mdi mdi-magnify"></i>
                  </button>
                </form>
              </div>
              <div class="select__HD">
                <div class="fistSelect__HD" id="selectTT" onclick="openMenu();">
                  Trạng thái đơn nhập
                  <span><i class="mdi mdi mdi-chevron-down"></i></span>
                </div>
                <div class="menu__HD" id="menuTT">
                  <div class="option__HD"><a href="index.php?action=warehouseManagement&query=searchStatus&Status=0">Đã thanh toán</a></div>
                  <div class="option__HD"><a href="index.php?action=warehouseManagement&query=searchStatus&Status=1">Chưa thanh toán</a></div>
                </div>
              </div>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Mã đơn đặt</th>
                    <th>Tên nhà cung cấp</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Quản lý</th>
                    <th>In</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_pnk)) {
                    $i++;
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['ImInvoiceID'] ?></td>
                      <td><?php echo $row['AccountName'] ?></td>
                      <td><?php echo $row['ImportDate'] ?></td>
                      <td><?php
                          if ($row['Status'] == 0) {
                            echo "Đã thanh toán";
                          } elseif ($row['Status'] == 1) {
                            echo '<a href="modules/warehouseManagement/handle.php?code=' . $row['ImInvoiceID'] . '">Chưa thanh toán</a>';
                          }
                          ?></td>
                      <td>
                        <a style="color:#fff;text-decoration:none;" href="index.php?action=warehouseManagement&query=detail&code=<?php echo $row['ImInvoiceID'] ?>">Xem đơn hàng</a>
                      </td>
                      <td>
                        <a style="color:#fff;text-decoration:none;" href="modules/warehouseManagement/print.php?code=<?php echo $row['ImInvoiceID'] ?>">In Đơn hàng</a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>