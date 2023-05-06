<?php
$sql_lietke_thuonghieu = "SELECT * FROM tblbrand ORDER BY BrandID DESC";
$query_lietke_thuonghieu = mysqli_query($mysqli, $sql_lietke_thuonghieu);
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-body-header">
              <h4 class="card-title">Danh sách thương hiệu</h4>
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-plus"></i>
                <a href="index.php?action=brandManagement&query=insert">Thêm thương hiệu </a>
              </button>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Tên thương hiệu</th>
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
                      <td><?php echo $row['BrandID'] ?></td>
                      <td><?php echo $row['BrandName'] ?></td>
                      <td>
                        <a href="modules/brandManagement/handle.php?BrandID=<?php echo $row['BrandID'] ?>" onClick="return confirm('Bạn có muốn xoá thương hiệu này không?')">Xoá</a> | <a href="?action=brandManagement&query=update&BrandID=<?php echo $row['BrandID'] ?>">Sửa</a>
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