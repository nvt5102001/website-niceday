<?php
if (isset($_GET['trang'])) {
  $page = $_GET['trang'];
} else {
  $page = 1;
}
if ($page == '' || $page == 1) {
  $begin = 0;
} else {
  $begin = ($page * 9) - 9;
}

$sql_lietke_dh = "SELECT * FROM tblretail_invoice,tblaccount 
  WHERE tblretail_invoice.CustomerAccID=tblaccount.AccountID 
  ORDER BY tblretail_invoice.ReInvoiceID DESC LIMIT $begin,9";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách đơn hàng</h4>
            <div class="search-container">
              <form action="index.php?action=orderManagement&query=search" method="POST">
                <input type="text" placeholder="Enter YYYY-MM-DD" name="tukhoaHD">
                <button name="timkiemHD" type="submit">
                  <i class="mdi mdi-magnify"></i>
                </button>
              </form>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Mã đơn đặt</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Quản lý</th>
                    <th>In</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_dh)) {
                    $i++;
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['ReInvoiceID'] ?></td>
                      <td><?php echo $row['AccountName'] ?></td>
                      <td><?php echo date('d/m/Y H:i:s', strtotime($row['TimeOrder'])) ?></td>
                      <td>
                        <?php if ($row['Status'] == 1) {
                          echo '<a href="modules/orderManagement/handle.php?code=' . $row['ReInvoiceID'] . '">Đơn hàng mới</a>';
                        } elseif ($row['Status'] == 2) {
                          echo 'Đã huỷ';
                        } else {
                          echo 'Đã xem';
                        }
                        ?>
                      </td>
                      <td>
                        <a style="color:#fff;text-decoration:none;" href="index.php?action=donhang&query=detail&code=<?php echo $row['ReInvoiceID'] ?>">Xem đơn hàng</a>
                      </td>
                      <td>
                        <a style="color:#fff;text-decoration:none;" href="modules/orderManagement/print.php?code=<?php echo $row['ReInvoiceID'] ?>">In Đơn hàng</a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>

              <?php
              $sql_trang = "SELECT * FROM tblretail_invoice,tblaccount 
          WHERE tblretail_invoice.CustomerAccID=tblaccount.AccountID 
          ORDER BY tblretail_invoice.ReInvoiceID DESC";
              $query_trang = mysqli_query($mysqli, $sql_trang);
              $row_count = mysqli_num_rows($query_trang);
              $trang = ceil($row_count / 9);
              $current_page = isset($_GET['trang']) ? (int) $_GET['trang'] : 1;
              ?>
              <?php
              if ($trang > 1) {
              ?>
                <p style="margin-top: 0.5rem;">Trang hiện tại : <?php echo $page ?>/<?php echo $trang ?> </p>
                <ul class="pagination">
                  <?php

                  for ($i = 1; $i <= $trang; $i++) {
                  ?>

                    <a href="index.php?action=orderManagement&query=select&trang=<?php echo $i ?>">
                      <li <?php echo ($i === $current_page) ? 'class="active"' : ''; ?>>
                        <?php echo $i ?>
                      </li>
                    </a>

                  <?php
                  }
                  ?>
                </ul>
              <?php
              } elseif ($trang == 0) {
                echo '<div class="non-search">Không tìm thấy hoá đơn</div>';
              } else {
                echo "";
              }
              ?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>