<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
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
<section class="shoping-cart-area">
	<div class="container">
		<form action="layout/main/order/PayProcess.php" method="POST">
			<div class="row" style="margin-bottom:20px;">
				<div class="col-md-12">
					<h2>Thông tin nhận hàng</h2>
					<h4><?php echo "<b>Tên khách hàng:</b> " . $consigneeName . ""; ?></h4>
					<h4><?php echo "<b>Số điện thoại:</b> 0" . $consigneePhone . ""; ?></h4>
					<h4><?php echo "<b>Địa chỉ:</b> " . $consigneeAddress . ""; ?></h4>
					<h4><?php echo "<b>Ghi chú:</b> " . $consigneeNote . ""; ?></h4>
				</div>
			</div>
			<div class="row">
				<div class="account-details">
					<div class="col-lg-8 col-md-8 col-sm-8">
						<div class="wishlist-table-area table-responsive">
							<table class="table-cart" >
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
							
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 xs-res-mrbtm hinhthucthanhtoan">
						<h4>Phương thức thanh toán</h4>
						
						<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="layout/main/momo/PayByQR.php">
							<input type="hidden" value="<?php echo $_SESSION['tongtien'] ?>" name="tongtien_vnd">
							<input type="submit" name="momo" value="Thanh toán MOMO QRcode" class="btn btn-danger">

						</form>
						<br><br>
						<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="layout/main/momo/PayByBank.php">
							<input type="hidden" value="<?php echo $_SESSION['tongtien'] ?>" name="tongtien_vnd">
							<input type="submit" name="momo" value="Thanh toán MOMO ATM" class="btn btn-danger">

						</form>
						<br><br>
						
						<div class="form-check">
							<input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="cash" checked>
							<label class="form-check-label" for="exampleRadios1">
								Trả tiền mặt khi nhận hàng
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="payment" id="exampleRadios4" value="vnpay">
							<img src="img/vnpay.png" height="20" width="64">
							<label class="form-check-label" for="exampleRadios4">
								Vnpay
							</label>
						</div>
						<input type="submit" value="Thanh toán ngay" name="redirect" class="btn btn-danger">
						
				</div>
			</form>


	</div>
	</div>
</section>

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