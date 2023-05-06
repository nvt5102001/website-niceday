<?php
$sql_lietke_thuonghieu = "SELECT * FROM tblstyle ORDER BY StyleName DESC";
$query_lietke_thuonghieu = mysqli_query($mysqli, $sql_lietke_thuonghieu);
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-body-header">
              <h4 class="card-title">Danh sách kiểu dáng</h4>
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-plus"></i>
                <a href="index.php?action=styleManagement&query=insert">Thêm kiểu dáng </a>
              </button>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Tên kiểu dáng</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_thuonghieu)) {
                    $i++;
                  ?>
                    <tr>
                      <td><?php echo $row['StyleID'] ?></td>
                      <td><?php echo $row['StyleName'] ?></td>
                      <td>
                        <a href="modules/styleManagement/handle.php?StyleID=<?php echo $row['StyleID'] ?>" onClick="return confirm('Bạn có muốn xoá kiểu dáng này không?')">Xoá</a> | <a href="?action=styleManagement&query=update&StyleID=<?php echo $row['StyleID'] ?>">Sửa</a>
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