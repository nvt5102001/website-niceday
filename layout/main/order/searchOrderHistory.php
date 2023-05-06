<div class="main-panel" style="margin:50px;">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Lịch sử mua hàng</h2>
            <div class="header__search" style="width:216px;">
						  <form action="index.php?page=searchOrderHistory" method="POST">
                <input type="text" placeholder="Enter date..." name="tukhoaHD">
                <button name="timkiemHD" type="submit" class="search-button">
                  <div class="icon icon-search icon-24"></div>
                </button>
              </form>
					  </div>
            <div class="table-responsive pt-3" style="margin-top:20px;background-color:#333; color:#fff;border-radius:20px;padding:10px;">
              <table class="table table-dark">
                <thead>
                  <tr>
                  <th>STT</th>
                    <th>Mã đơn đặt</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Huỷ đơn hàng</th>
                    <th>Xem đơn hàng</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  // Tìm kiếm lịch sủ mua hàng
                  $id_khachhang = $_SESSION['AccountID'];
                  if (isset($_POST['timkiemHD'])) {
                    $tukhoa = $_POST['tukhoaHD'];
                  }
                  if ($tukhoa != " ") {
                    $sql_lietke_dh = "SELECT * FROM tblretail_invoice,tblaccount WHERE tblretail_invoice.CustomerAccID = tblaccount.AccountID AND tblretail_invoice.CustomerAccID = '$id_khachhang' AND  tblretail_invoice.TimeOrder LIKE '%" . $tukhoa . "%' ORDER BY tblretail_invoice.ReInvoiceID DESC";
                    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
                    $count = mysqli_num_rows($query_lietke_dh);
                    if ($count <= 0) {
                      echo "<tr>
                                <td colspan='8' style='text-align:center;'>Không tìm thấy lịch sử mua hàng!</td>
                            </tr>";
                    }
                  } else {
                    $sql_lietke_dh = "SELECT * FROM tblretail_invoice,tblaccount WHERE tblretail_invoice.CustomerAccID=tblaccount.AccountID AND tblretail_invoice.CustomerAccID='$id_khachhang'  ORDER BY tblretail_invoice.ReInvoiceID DESC";
                    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
                  }


                  // Hiển thị đơn hàng đã mua
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_dh)) {
                    $i++;
                  ?>
                   <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['ReInvoiceID'] ?></td>
                      <td><?php echo $row['AccountName'] ?></td>
                      <td><?php echo $row['TimeOrder'] ?></td>
                      <td>
                        <?php
                        if ($row['Status'] == 1) {
                          echo 'Đang xử lý';
                        } elseif ($row['Status'] == 2) {
                          echo 'Đã huỷ';
                        } else {
                          echo 'Đã xử lý';
                        }
                        ?>

                      </td>
                      <td>
                        <?php
                        if ($row['Status'] == 1) {
                          echo '<a href="layout/main/order/OrderCancel.php?code=' . $row['ReInvoiceID'] . '" onClick="return confirm(\'Bạn có muốn huỷ đơn hàng không?\')" >Huỷ đơn hàng</a>';
                        } else {
                          echo '';
                        }
                        ?>

                      </td>
                      <td>
                        <a href="index.php?page=xemctdh&code=<?php echo $row['ReInvoiceID'] ?>">Xem đơn hàng</a>
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