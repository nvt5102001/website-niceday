<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body-header">
                            <h4 class="card-title">Thêm sản phẩm</h4>
                            <button class="btn btn-outline-dark btn-icon-text">
                                <i class="mdi mdi-arrow-left"></i>
                                <a href="index.php?action=quanlysp&query=select">Quay lại</a>
                            </button>
                        </div>
                        <h6>Kiểm tra sản phẩm</h6>
                        <div class="search-container">
                            <form action="index.php?action=warehouseManagement&query=checkSP" method="POST">
                                <input type="text" placeholder="Enter product" name="tukhoacheck">
                                <button name="checkSP" type="submit">
                                    <i class="mdi mdi-magnify"></i>
                                </button>

                                <?php
                                if (isset($_POST['checkSP'])) {
                                    $tukhoa = $_POST['tukhoacheck'];
                                }
                                if ($tukhoa != " ") {
                                    $sql_check_sp = "SELECT * FROM tblproduct WHERE ProductName ='" . $tukhoa . "' ";
                                    $query_check_sp = mysqli_query($mysqli, $sql_check_sp);
                                    $count = mysqli_num_rows($query_check_sp);
                                    if ($count <= 0) {
                                        echo "
                                <span style='color:red;margin-left: 60px; position: relative;'>
                                <i class='mdi mdi-close' style='position: absolute;
                                top: 15%;
                                left: -20px;'></i>Chưa có </span>
                                ";
                                    } else {
                                        echo "<span style='color:green;margin-left: 60px; position: relative;'>
                                <i class='mdi mdi-check' style='position: absolute;
                                top: 15%;
                                left: -20px;'></i>Đã có </span>
                                ";
                                    }
                                } else {
                                    echo "<span style='color:yellow;margin-left:50px;>Vui lòng nhập sản phẩm</span>";
                                }

                                ?>
                            </form>

                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-light">
                                <form method="POST" action="modules/warehouseManagement/insert.php">
                                    <tr>
                                        <td>Sản phẩm mới</td>
                                        <td>
                                            <button class="btn btn-white">
                                                <a href="index.php?action=quanlysp&query=insertDetail" class="text-dark">Thêm sản phẩm mới</a>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                            <td colspan="2" style="text-align:center;">Or</td>
                        </tr> -->
                                    <tr>
                                        <td>Sản phẩm đã có</td>
                                        <td>
                                            <select name="sp">
                                                <?php
                                                $sql_sp = "SELECT * FROM tblproduct, tblcolor WHERE tblproduct.ColorID = tblcolor.ColorID ORDER BY ProductID DESC";
                                                $query_sp = mysqli_query($mysqli, $sql_sp);
                                                while ($row_sp = mysqli_fetch_array($query_sp)) {
                                                ?>
                                                    <option value="<?php echo $row_sp['ProductID'] ?>">
                                                        <?php
                                                        echo $row_sp['ProductName'];
                                                        echo " - ";
                                                        echo $row_sp['ColorName'];
                                                        ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng nhập</td>
                                        <td><input type="text" name="QuantityImOrder"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" name="insert" class="btn btn-outline-dark btn-icon-text">
                                                Tạo chi tiết phiếu nhập
                                                <i class="ti-file btn-icon-append"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-dark">
                            <thead>
                                <tr>

                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['ctPNK'])) {
                                    $i = 0;
                                    $tongtien = 0;
                                    foreach ($_SESSION['ctPNK'] as $ctPNK_item) {
                                        $thanhtien = $ctPNK_item['QuantityImOrder'] * $ctPNK_item['ImportPrice'];
                                        $tongtien += $thanhtien;
                                        $_SESSION['tongtien_pnk'] = $tongtien;
                                        $i++;
                                ?>
                                        <tr>


                                            <td class="product-name">
                                                <h4><?php echo $ctPNK_item['ProductName']; ?></h4>
                                            </td>
                                            <td class="product-name">
                                                <h4><?php echo $ctPNK_item['QuantityImOrder']; ?></h4>
                                            </td>
                                            <td class="product-unit-price">
                                                <p><?php echo number_format($ctPNK_item['ImportPrice'], 0, ',', '.') . 'vnđ'; ?></p>
                                            </td>

                                            <td class="product-quantity">
                                                <p><?php echo number_format($thanhtien, 0, ',', '.') . 'vnđ' ?></p>
                                            </td>
                                            <td>
                                                <a href="modules/warehouseManagement/insert.php?xoa=<?php echo $ctPNK_item['id'] ?>">Xoá</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                <?php
                                } else {
                                    $block_DH = 1;
                                ?>
                                    <tr>
                                        <td colspan="8" style="height:50px;text-align:center;">Chưa nhập sản phẩm</td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-light">
                            <form method="POST" action="modules/warehouseManagement/handle.php">
                                <tr>
                                    <td>Tên người cung cấp</td>
                                    <td><input type="text" name="DeliverName"></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td><input type="text" name="DeliverPhone"></td>
                                </tr>
                                <tr>
                                    <td>Tài khoản nhà cung cấp</td>
                                    <td>
                                        <select name="tkncc">
                                            <?php
                                            $sql_ncc = "SELECT * FROM tblaccount WHERE AccessPermissions='4' ORDER BY AccountID DESC";
                                            $query_ncc = mysqli_query($mysqli, $sql_ncc);
                                            while ($row_ncc = mysqli_fetch_array($query_ncc)) {
                                            ?>
                                                <option value="<?php echo $row_ncc['AccountID'] ?>"><?php echo $row_ncc['AccountName'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Trạng thái</td>
                                    <td>
                                        <select name="Status" id="">
                                            <option value="0">Đã thanh toán</option>
                                            <option value="1">Chưa thanh toán</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- <tr>
                            <td>Thời gian</td>
                            <td><input type="date" name="ImportDate" id=""></td>
                        </tr> -->
                                <tr>
                                    <td>Nhân viên</td>
                                    <td>
                                        <select name="tknv">
                                            <?php
                                            $sql_nv = "SELECT * FROM tblaccount WHERE AccessPermissions='2' ORDER BY AccountID DESC";
                                            $query_nv = mysqli_query($mysqli, $sql_nv);
                                            while ($row_nv = mysqli_fetch_array($query_nv)) {
                                            ?>
                                                <option value="<?php echo $row_nv['AccountID'] ?>"><?php echo $row_nv['AccountName'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button type="submit" name="thempnk" class="btn btn-outline-dark btn-icon-text">
                                            Tạo phiếu nhập kho
                                            <i class="ti-file btn-icon-append"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>