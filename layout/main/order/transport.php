<?php
if (isset($_POST['themvanchuyen'])) {
    $consigneeName = $_POST['consigneeName'];
    $consigneePhone = $_POST['consigneePhone'];
    $consigneeAddress = $_POST['consigneeAddress'];
    $consigneeNote = $_POST['consigneeNote'];
    $id_dangky = $_SESSION['AccountID'];
    $sql_them_vanchuyen = mysqli_query($mysqli, "INSERT INTO tbltransport(ConsigneeName,ConsigneePhone,ConsigneeAddress,ConsigneeNote,AccountID ) VALUES('$consigneeName','$consigneePhone','$consigneeAddress','$consigneeNote','$id_dangky')");
    if ($sql_them_vanchuyen) {
        echo '<script>alert("Thêm vận chuyển thành công")</script>';
    }
} elseif (isset($_POST['capnhatvanchuyen'])) {
    $consigneeName = $_POST['consigneeName'];
    $consigneePhone = $_POST['consigneePhone'];
    $consigneeAddress = $_POST['consigneeAddress'];
    $consigneeNote = $_POST['consigneeNote'];
    $id_dangky = $_SESSION['AccountID'];
    $sql_update_vanchuyen = mysqli_query($mysqli, "UPDATE tbltransport SET ConsigneeName='$consigneeName',ConsigneePhone='$consigneePhone',ConsigneeAddress='$consigneeAddress',ConsigneeNote='$consigneeNote',AccountID='$id_dangky' WHERE AccountID='$id_dangky'");
    if ($sql_update_vanchuyen) {
        echo '<script>alert("Cập nhật vận chuyển thành công")</script>';
    }
}
?>

<!-- MENU AREA END -->
<!-- BANNER AREA STRAT -->
<section class="bannerhead-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-heading">
                    <h1>Vận chuyển</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- BANNER AREA END -->
<!-- ACOOUNT FROM AREA START -->
<section class="login-area">
    <div class="container">
        <div class="row">
            <?php
            $id_dangky = $_SESSION['AccountID'];
            $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbltransport WHERE AccountID='$id_dangky' LIMIT 1");
            $count = mysqli_num_rows($sql_get_vanchuyen);
            if ($count > 0) {
                $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
                $consigneeName = $row_get_vanchuyen['ConsigneeName'];
                $consigneePhone = $row_get_vanchuyen['ConsigneePhone'];
                $consigneeAddress = $row_get_vanchuyen['ConsigneeAddress'];
                $consigneeNote = $row_get_vanchuyen['ConsigneeNote'];
            } else {

                $consigneeName = '';
                $consigneePhone = '';
                $consigneeAddress = '';
                $consigneeNote = '';
            }
            ?>

            <div class="account-details">
                <div class="col-lg-4 col-md-4 col-sm-4 xs-res-mrbtm">
                    <form class="create-account-form" action="" autocomplete="off" method="POST">
                        <h1 class="heading-title">Thông tin nhận hàng</h1>
                        <p class="form-row">
                            <label>Tên người nhận</label>
                            <input type="text" name="consigneeName" value="<?php echo $consigneeName ?>">
                        </p>
                        <p class="form-row">
                            <label>Số điện thoại</label>
                            <input type="text" name="consigneePhone" value="<?php echo "0$consigneePhone" ?>">
                        </p>
                        <p class="form-row">
                            <label>Địa chỉ</label>
                            <input type="text" name="consigneeAddress" value="<?php echo $consigneeAddress ?>">
                        </p>
                        <p class="form-row">
                            <label>Ghi chú</label>
                        <div class="input-message">
                            <textarea name="consigneeNote"><?php echo $consigneeNote ?></textarea>
                        </div>

                        </p>

                        <?php
                        if ($consigneeName == '' && $consigneePhone == '') {
                        ?>
                            <button name="themvanchuyen" id="submitcreate" type="submit" class="">
                                <span>
                                    <i class="fa fa-user left"></i>
                                    Thêm vận chuyển
                                </span>
                            </button>

                        <?php
                        } elseif ($consigneeName != '' && $consigneePhone != '') {
                        ?>
                            <button name="capnhatvanchuyen" id="submitcreate" type="submit" class="">
                                <span>
                                    <i class="fa fa-user left"></i>
                                    Cập nhật vận chuyển
                                </span>
                            </button>
                        <?php
                        }
                        ?>

                    </form>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="wishlist-table-area table-responsive">
                        <table class="table-cart">
                            <thead>
                                <tr>
                                    <th class="product-stt">STT</th>
                                    <th class="product-image">Image</th>
                                    <th class="product-name">Product Name</th>
                                    <th class="product-unit-price">Unit Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Subtotal</th>

                                </tr>
                            </thead>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $i = 0;
                                $tongtien = 0;
                                foreach ($_SESSION['cart'] as $cart_item) {
                                    $thanhtien = $cart_item['Quantity'] * $cart_item['Price'];
                                    $tongtien += $thanhtien;
                                    $_SESSION['tongtien'] = $tongtien;
                                    $i++;
                            ?>
                                    <tr>
                                        <td class="product-stt">
                                            <p><?php echo $i; ?></p>
                                        </td>
                                        <td class="product-image">
                                            <img src="admin/modules/productManagement/uploads/<?php echo $cart_item['Image']; ?>" width="150px;">
                                        </td>
                                        <td class="product-name">
                                            <h4><?php echo $cart_item['ProductName']; ?></h4>
                                        </td>
                                        <td class="product-unit-price">
                                            <p><?php echo number_format($cart_item['Price'], 0, ',', '.') . 'vnđ'; ?></p>
                                        </td>
                                        <td class="product-quantity product-cart-details">
                                            <?php echo $cart_item['Quantity']; ?>
                                        </td>
                                        <td class="product-quantity">
                                            <p><?php echo number_format($thanhtien, 0, ',', '.') . 'vnđ' ?></p>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="8" style="height:100px;">

                                    <h4>
                                        Tổng tiền
                                        <?php
                                        echo number_format($tongtien, 0, ',', '.') . 'vnđ';
                                        ?>
                                    </h4>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="shopingcart-bottom-area">
                        <a href="index.php?page=giohang" class="bottoma">QUAY LẠi GIỎ HÀNG</a>
                        <div class="bottom-button">
                            <a href="index.php?page=checkout" class="bottomb">TIẾP TỤC ĐẶT HÀNG</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
</section>


<!-- ACOOUNT FROM AREA END -->
<!-- OUR BRAND AREA START -->
<section class="our-brand-area">
    <div class="container">
        <div class="text-center">
            <div class="section-titel">
                <h3>OUR BRANDS</h3>
            </div>
        </div>
        <div class="row blog-area">
            <div id="ourbrand-owl">
                <div class="col-md-12"><img src="img/other-pg/brand-logo-1.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-2.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-3.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-4.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-5.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-3.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-1.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-2.jpg" alt="" /></div>
            </div>
        </div>
    </div>
</section>
<!-- OUR BRAND AREA END -->