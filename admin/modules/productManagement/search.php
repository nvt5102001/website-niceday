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


if (isset($_POST['timkiemSP'])) {
  $tukhoa = $_POST['tukhoaSP'];
}

if ($tukhoa == " ") {
  $sql_lietke_sp = "SELECT * FROM tblproduct,tblbrand,tblcategory 
    WHERE tblproduct.BrandID = tblbrand.BrandID 
    and tblproduct.CategoryID = tblcategory.CategoryID 
    ORDER BY ProductID DESC LIMIT $begin,9";
  $query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
} else {
  $sql_lietke_sp = "SELECT * FROM tblproduct,tblbrand,tblcategory WHERE tblproduct.BrandID = tblbrand.BrandID and tblproduct.CategoryID = tblcategory.CategoryID AND tblproduct.ProductName LIKE '%" . $tukhoa . "%' ORDER BY ProductID DESC LIMIT $begin,9";
  $query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
}

?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-body-header">
              <h4 class="card-title">Danh sách sản phẩm</h4>
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-plus"></i>
                <a href="index.php?action=productManagement&query=insert">Thêm sản phẩm </a>
              </button>
            </div>
            <div class="search-container">
              <form action="index.php?action=productManagement&query=search" method="POST">
                <input type="text" placeholder="Enter your keyword..." name="tukhoaSP">
                <button name="timkiemSP" type="submit">
                  <i class="mdi mdi-magnify"></i>
                </button>
              </form>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-dark" style="width:100%;">
                <thead>
                  <tr>
                    <th>Quản lý</th>
                    <th>Id</th>
                    <th>Tên sản phẩm</th>
                    <th>Loại sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Hình ảnh</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_sp)) {
                    $i++;
                  ?>
                    <tr>
                      <td>
                        <div style="display:flex;align-items:center;">
                          <a href="modules/productManagement/handle.php?ProductID=<?php echo $row['ProductID'] ?>">
                            <i class="mdi mdi-cup menu-icon" title="Xoá" style="font-size:16px;color:#fff;"></i>
                          </a>
                          <span style="margin: 0 10px 5px 10px;">|</span>
                          <a href="index.php?action=productManagement&query=update&ProductID=<?php echo $row['ProductID'] ?>">
                            <i class="mdi mdi-border-color menu-icon" title="Sửa" style="font-size:16px;color:#fff;"></i>
                          </a>
                        </div>
                      </td>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['ProductName'] ?></td>
                      <td><?php echo $row['CategoryName'] ?></td>
                      <td><?php echo $row['Quantity'] ?></td>
                      <td><?php echo $row['Price'] ?></td>
                      <td><img src="modules/productManagement/uploads/<?php echo $row['Image'] ?>" wBrandID="150px"></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>

              <?php
              $sql_trang = "SELECT * FROM tblproduct,tblbrand,tblcategory 
                      WHERE tblproduct.BrandID = tblbrand.BrandID 
                      and tblproduct.CategoryID = tblcategory.CategoryID
                      and tblproduct.ProductName LIKE '%" . $tukhoa . "%' ORDER BY ProductID DESC";
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

                    <a href="index.php?action=productManagement&query=select&trang=<?php echo $i ?>">
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
                echo '<div class="non-search">Không tìm thấy sản phẩm</div>';
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