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
$sql_pro = "SELECT * FROM tblproduct, tblcategory  WHERE tblproduct.CategoryID  = tblcategory.CategoryID  ORDER BY tblproduct.ProductID  DESC LIMIT $begin,9";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>

<div class="col-md-9">
    <div class="shop-right-area">

        <div class="shop-tab-area">
            <!--NAV PILL-->
            <div class="shop-tab-pill">
                <ul>
                    <li class="active" id="p-mar">
                        <a data-toggle="pill" href="#grid">
                            <i class="fa fa-th" aria-hidden="true"></i>
                            <span>Grid</span>
                        </a>
                    </li>

                    <li class="product-size-deatils">
                        <div class="show-label">
                            <label>Show : </label>
                            <select>
                                <option value="10" selected="selected">10</option>
                                <option value="09">09</option>
                                <option value="08">08</option>
                                <option value="07">07</option>
                                <option value="06">06</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="sort-position">
                            <label><i class="fa fa-sort-amount-asc"></i>Sort by : </label>
                            <select>
                                <option value="position" selected="selected">Position</option>
                                <option value="Name">Name</option>
                                <option value="Price">Price</option>
                            </select>
                        </div>
                    </li>
                </ul>
            </div>
            <!--NAV PILL-->
            <div class="tab-content">
                <div class="row tab-pane active" id="grid">
                    <?php
                    $count = 0;
                    while ($row = mysqli_fetch_array($query_pro)) {
                        $count++;
                    ?>
                        <div class="col-md-4 col-sm-4">
                            <div class="single-product">
                                <div class="product-image">
                                    <a class="product-img" href="index.php?page=sanpham&ProductID=<?php echo $row['ProductID'] ?>">
                                        <img class="primary-img" src="admin/modules/quanlysp/uploads/<?php echo $row['Image'] ?>" alt="" style="height:280px;" />
                                    </a>
                                </div>
                                <span class="onsale">
                                    <span class="sale-text">Sale </span>
                                </span>
                                <div class="product-action">
                                    <h4 id="sp<?php echo $count ?>"><a href="#"><?php echo $row['ProductName'] ?></a></h4>
                                    <ul class="pro-rating">
                                        <li class="pro-ratcolor"><i class="fa fa-star"></i></li>
                                        <li class="pro-ratcolor"><i class="fa fa-star"></i></li>
                                        <li class="pro-ratcolor"><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <div style="display:flex;justify-content:space-between;">
                                        <span class="price"><?php echo number_format($row['Price'], 0, ',', '.') . 'vnđ' ?></span>
                                        <span><?php
                                                if ($row['Quantity'] <= 0) {
                                                    echo "Hết hàng";
                                                } else {
                                                    echo "Còn hàng";
                                                }
                                                ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div style="clear:both;"></div>
                <style type="text/css">
                    ul.list_trang {
                        padding: 0;
                        margin: 0;
                        list-style: none;
                    }

                    ul.list_trang li {
                        float: left;
                        padding: 5px 13px;
                        margin: 5px;
                        background: #aaa;
                        display: block;
                    }

                    ul.list_trang li a {
                        color: #000;
                        text-align: center;
                        text-decoration: none;

                    }
                </style>
                <?php
                $sql_trang = mysqli_query($mysqli, "SELECT * FROM tblsanpham");
                $row_count = mysqli_num_rows($sql_trang);
                $trang = ceil($row_count / 9);
                ?>
                <p>Trang hiện tại : <?php echo $page ?>/<?php echo $trang ?> </p>

                <ul class="list_trang">

                    <?php

                    for ($i = 1; $i <= $trang; $i++) {
                    ?>
                        <li><a href="index.php?page=shop&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
            <!--NAV PILL-->
        </div>
    </div>
</div>