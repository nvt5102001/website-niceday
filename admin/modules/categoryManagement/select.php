<?php
$sql_lietke_loaisp = "SELECT * FROM tblcategory ORDER BY CategoryID DESC";
$query_lietke_loaisp = mysqli_query($mysqli, $sql_lietke_loaisp);
?>


<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-body-header">
              <h4 class="card-title">Danh sách loại sản phẩm</h4>
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-plus"></i>
                <a href="index.php?action=categoryManagement&query=insert">Thêm loại </a>
              </button>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Tên loại</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_loaisp)) {
                    $i++;
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['CategoryName'] ?></td>
                      <td>
                        <a href="modules/categoryManagement/handle.php?CategoryID=<?php echo $row['CategoryID'] ?>" onClick="return confirm('Bạn có muốn xoá loại sản phẩm này không?')">Xoá</a> | <a href="?action=categoryManagement&query=update&CategoryID=<?php echo $row['CategoryID'] ?>">Sửa</a>
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