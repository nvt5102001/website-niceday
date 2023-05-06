<?php

$sql_thuonghieu = "SELECT * FROM tblbrand ORDER BY BrandID DESC";
$query_thuonghieu = mysqli_query($mysqli, $sql_thuonghieu);

$sql_sp = "SELECT * FROM tblproduct ORDER BY ProductID DESC";
$query_sp = mysqli_query($mysqli, $sql_sp);

?>
<div class="col-md-3">
    <div class="wishlist-left-area">
        <div class="category">
            <h4>Loại sản phẩm</h4>
            <div class="category-list">
                <?php
                // Lấy danh sách các danh mục cha
                $sql_loaisp = "SELECT * FROM tblcategory WHERE CategoryParentID = 0 ORDER BY CategoryID DESC";
                $query_loaisp = mysqli_query($mysqli, $sql_loaisp);

                // Duyệt qua từng danh mục cha
                while ($row_loaisp = mysqli_fetch_assoc($query_loaisp)) {
                    $categoryParentID = $row_loaisp['CategoryID'];

                    // Lấy danh sách các danh mục con tương ứng
                    $sql_getCategoryChild = "SELECT * FROM tblcategory WHERE CategoryParentID ='$categoryParentID' ";
                    $query_getCategoryChild = mysqli_query($mysqli, $sql_getCategoryChild);
                ?>
                    <!-- Hiển thị danh mục cha -->
                    <ul class="list-parent">
                        <li style="font-size: 16px;">
                            <span><i class="fa fa-angle-double-right"></i><?php echo $row_loaisp['CategoryName'] ?></span>

                            <!-- Hiển thị danh sách các danh mục con -->
                            <ul class="list-child">
                                <?php while ($row_loaispchild = mysqli_fetch_array($query_getCategoryChild)) { ?>
                                    <li>
                                        <a href="index.php?page=loaisp&CategoryID=<?php echo $row_loaispchild['CategoryID'] ?>"><i class="fa fa-angle-double-right"></i><?php echo $row_loaispchild['CategoryName'] ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>

        <div class="popular-tag filter-color">
            <h4>Màu sắc</h4>
            <div class="colors"><?php
                                $sql_color = "SELECT * FROM tblcolor ORDER BY ColorID DESC";
                                $query_color = mysqli_query($mysqli, $sql_color);
                                while ($row_color = mysqli_fetch_array($query_color)) {
                                ?>
                    <a style="display:inline-block;" href="index.php?page=color&ColorID=<?php echo $row_color['ColorID'] ?>">
                        <img src="admin/modules/colorManagement/uploads/<?php echo $row_color['ImageColor'] ?>" alt="" title="<?php echo $row_color['ColorName'] ?>" width="30px;" height="30px;">
                    </a>
                <?php
                                }
                ?>
            </div>
        </div>

        <div class="popular-tag">
            <h4>Giá</h4>
            <ul>
                <li>
                    <?php
                    $sql_price = "SELECT 
                            CASE 
                            WHEN Price >= 100000 AND Price <= 300000  THEN '100.000 đ - 300.000 đ'
                            WHEN Price >= 300000 AND Price <= 500000  THEN '300.000 đ - 500.000 đ'
                            WHEN Price >= 500000 AND Price <= 6000000  THEN '500.000 đ - 6.000.000 đ'
                            ELSE '6.000.000 đ - 10.000.000 đ' 
                            END AS PriceGroup,
                            GROUP_CONCAT(ProductID) AS ProductIDs 
                        FROM tblproduct 
                        GROUP BY PriceGroup 
                        ORDER BY PriceGroup ASC";
                    $query_price = mysqli_query($mysqli, $sql_price);

                    while ($row_price = mysqli_fetch_array($query_price)) {

                    ?>
                        <a style="display:block;text-transform: lowercase;" href="index.php?page=price&ids=<?php echo $row_price['ProductIDs'] ?>"><?php echo $row_price['PriceGroup'] ?></a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>




        <div class="popular-tag">
            <h4>Thương hiệu</h4>
            <ul>
                <li>
                    <?php
                    while ($row_thuonghieu = mysqli_fetch_array($query_thuonghieu)) {
                    ?>
                        <a style="display:inline-block;" href="index.php?page=thuonghieu&BrandID=<?php echo $row_thuonghieu['BrandID'] ?>"><?php echo $row_thuonghieu['BrandName'] ?></a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</div>