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

$sql_lietke_color = "SELECT * FROM tblcolor ORDER BY ColorID DESC LIMIT $begin,9";
$query_lietke_color = mysqli_query($mysqli, $sql_lietke_color);
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-body-header">
              <h4 class="card-title">Danh sách màu sắc</h4>
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-plus"></i>
                <a href="index.php?action=colorManagement&query=insert">Thêm màu sắc </a>
              </button>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Tên màu</th>
                    <th>Hình ảnh</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_color)) {
                    $i++;
                  ?>
                    <tr>
                      <td><?php echo $row['ColorID'] ?></td>
                      <td><?php echo $row['ColorName'] ?></td>
                      <td><img src="modules/colorManagement/uploads/<?php echo $row['ImageColor'] ?>" width="150px"></td>

                      <td>
                        <a href="modules/colorManagement/handle.php?ColorID=<?php echo $row['ColorID'] ?>" onClick="return confirm('Bạn có muốn xoá thương hiệu này không?')">Xoá</a> | <a href="?action=colorManagement&query=update&ColorID=<?php echo $row['ColorID'] ?>">Sửa</a>
                      </td>

                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>

              <?php
              $sql_trang = "SELECT * FROM tblcolor";
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

                    <a href="index.php?action=colorManagement&query=select&trang=<?php echo $i ?>">
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
                echo "Không tìm thấy sản phẩm";
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