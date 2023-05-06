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

if (isset($_POST['searchAccount'])) {
  $tukhoa = $_POST['keywordAccount'];
}

if ($tukhoa == " ") {
  $sql_lietke_tk = "SELECT * FROM tblaccount ORDER BY AccessPermissions ASC LIMIT $begin,9";
  $query_lietke_tk = mysqli_query($mysqli, $sql_lietke_tk);
} else {
  $sql_lietke_tk = "SELECT * FROM tblaccount WHERE tblaccount.AccountName LIKE '%" . $tukhoa . "%' ORDER BY AccessPermissions ASC LIMIT $begin,9";
  $query_lietke_tk = mysqli_query($mysqli, $sql_lietke_tk);
}
?>


<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-body-header">
              <h4 class="card-title">Danh sách tài khoản</h4>
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-plus"></i>
                <a href="index.php?action=quanlytaikhoan&query=insert">Thêm tài khoản </a>
              </button>
            </div>
            <div class="search-container">
              <form action="index.php?action=quanlytaikhoan&query=search" method="POST">
                <input type="text" placeholder="Enter your keyword..." name="keywordAccount">
                <button name="searchAccount" type="submit">
                  <i class="mdi mdi-magnify"></i>
                </button>
              </form>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Gmail</th>
                    <th>Tên tài khoản</th>
                    <th>Loại tài khoản</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_tk)) {
                    $i++;
                  ?>
                    <tr>
                      <td><?php echo $row['AccountID'] ?></td>
                      <td><?php echo $row['Gmail'] ?></td>
                      <td><?php echo $row['AccountName'] ?></td>
                      <td><?php
                          if ($row['AccessPermissions'] == 1) {
                            echo "Khách hàng";
                          } elseif ($row['AccessPermissions'] == 0) {
                            echo "Quản lý";
                          } elseif ($row['AccessPermissions'] == 2) {
                            echo "Nhân viên";
                          } elseif ($row['AccessPermissions'] == 3) {
                            echo "Vận chuyển";
                          } elseif ($row['AccessPermissions'] == 4) {
                            echo "Nhà cung cấp";
                          }
                          ?></td>
                      <td><?php echo "0" . $row['PhoneNumber'] ?></td>
                      <td><?php echo $row['Address'] ?></td>

                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>

              <?php
              $query_trang = mysqli_query($mysqli, "SELECT * FROM tblaccount");
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

                    <a href="index.php?action=quanlytaikhoan&query=select&trang=<?php echo $i ?>">
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
                echo '<div class="non-search">Không tìm thấy tài khoản</div>';
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