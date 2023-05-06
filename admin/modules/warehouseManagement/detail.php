<?php
$code = $_GET['code'];
$sql_lietke_pnk = "SELECT * FROM tblimport_invoice_detail,tblproduct WHERE tblimport_invoice_detail.ProductID=tblproduct.ProductID AND tblimport_invoice_detail.ImInvoiceID='" . $code . "' ORDER BY tblimport_invoice_detail.ImDetailID DESC";
$query_lietke_pnk = mysqli_query($mysqli, $sql_lietke_pnk);

$sql_lietke_nv = "SELECT * FROM tblimport_invoice,tblaccount WHERE tblimport_invoice.EmployeeAccID=tblaccount.AccountID AND tblimport_invoice.ImInvoiceID = '" . $code . "'  ORDER BY tblimport_invoice.ImInvoiceID DESC";
$query_lietke_nv = mysqli_query($mysqli, $sql_lietke_nv);

$sql_lietke_ncc = "SELECT * FROM tblimport_invoice,tblaccount WHERE tblimport_invoice.SupplierAccID=tblaccount.AccountID AND tblimport_invoice.ImInvoiceID = '" . $code . "' ORDER BY tblimport_invoice.ImInvoiceID DESC";
$query_lietke_ncc = mysqli_query($mysqli, $sql_lietke_ncc);


?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Chi tiết đơn hàng</h4>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  $tongtien = 0;
                  while ($row = mysqli_fetch_array($query_lietke_pnk)) {
                    $i++;
                    $thanhtien = $row['ImportPrice'] * $row['QuantityImOrder'];
                    $tongtien += $thanhtien;
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['ImDetailID'] ?></td>
                      <td><?php echo $row['ProductName'] ?></td>
                      <td><?php echo $row['QuantityImOrder'] ?></td>
                      <td><?php echo number_format($row['ImportPrice'], 0, ',', '.') . 'vnđ' ?></td>
                      <td><?php echo number_format($thanhtien, 0, ',', '.') . 'vnđ' ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                  <tr>
                    <td colspan="6">
                      <p>Tổng tiền : <?php echo number_format($tongtien, 0, ',', '.') . 'vnđ' ?></p>
                    </td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="table-child">

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Nhân viên</h4>
              <div class="table-responsive pt-3">
                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th>AccountID</th>
                      <th>Tên tài khoản</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    while ($row = mysqli_fetch_array($query_lietke_nv)) {

                    ?>
                      <tr>
                        <td><?php echo $row['AccountID'] ?></td>
                        <td><?php echo $row['AccountName'] ?></td>
                        <td><?php echo "0" . $row['PhoneNumber'] ?></td>
                        <td><?php echo $row['Address'] ?></td>
                      <?php
                    }
                      ?>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Nhà cung cấp</h4>
              <div class="table-responsive pt-3">
                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th>AccountID</th>
                      <th>Tên tài khoản</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    while ($row = mysqli_fetch_array($query_lietke_ncc)) {

                    ?>
                      <tr>
                        <td><?php echo $row['AccountID'] ?></td>
                        <td><?php echo $row['AccountName'] ?></td>
                        <td><?php echo "0" . $row['PhoneNumber'] ?></td>
                        <td><?php echo $row['Address'] ?></td>
                      <?php
                    }
                      ?>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>