<?php
$code = $_GET['code'];
$sql_lietke_dh = "SELECT * FROM tblretail_invoice_detail, tblproduct WHERE tblretail_invoice_detail.ProductID = tblproduct.ProductID AND tblretail_invoice_detail.ReInvoiceID='" . $code . "' ORDER BY tblretail_invoice_detail.ReDetailID  DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);

$sql_lietke_nv = "SELECT * FROM tblretail_invoice,tblaccount WHERE tblretail_invoice.EmployeeAccID=tblaccount.AccountID AND tblretail_invoice.ReInvoiceID = '" . $code . "'  ORDER BY tblretail_invoice.ReInvoiceID DESC";
$query_lietke_nv = mysqli_query($mysqli, $sql_lietke_nv);

$sql_lietke_kh = "SELECT * FROM tblretail_invoice,tblaccount WHERE tblretail_invoice.CustomerAccID=tblaccount.AccountID AND tblretail_invoice.ReInvoiceID = '" . $code . "' ORDER BY tblretail_invoice.ReInvoiceID DESC";
$query_lietke_kh = mysqli_query($mysqli, $sql_lietke_kh);


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
                  while ($row = mysqli_fetch_array($query_lietke_dh)) {
                    $i++;
                    $thanhtien = $row['PriceReOrder'] * $row['QuantityReOrder'];
                    $tongtien += $thanhtien;
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['ReInvoiceID'] ?></td>
                      <td><?php echo $row['ProductName'] ?></td>
                      <td><?php echo $row['QuantityReOrder'] ?></td>
                      <td><?php echo number_format($row['PriceReOrder'], 0, ',', '.') . 'vnđ' ?></td>
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
                      <th>Gmail</th>
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
                        <td><?php echo $row['Gmail'] ?></td>
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
              <h4 class="card-title">Khách hàng</h4>
              <div class="table-responsive pt-3">
                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th>Gmail</th>
                      <th>Tên tài khoản</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    while ($row = mysqli_fetch_array($query_lietke_kh)) {

                    ?>
                      <tr>
                        <td><?php echo $row['Gmail'] ?></td>
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