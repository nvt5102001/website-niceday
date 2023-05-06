<?php
$sql_chitiet = "SELECT * FROM tblproduct,tblcategory WHERE tblproduct.CategoryID = tblcategory.CategoryID AND tblproduct.ProductID='$_GET[ProductID]' LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);

$sql_related = "SELECT BrandName FROM tblproduct,tblbrand WHERE tblproduct.BrandID = tblbrand.BrandID AND tblproduct.ProductID='$_GET[ProductID]'";
$query_related = mysqli_query($mysqli, $sql_related);

$related_products = "";
while ($row = mysqli_fetch_assoc($query_related)) {
	$related_products = $row['BrandName'];
}
$sql_relatedProc = "SELECT * FROM tblproduct,tblbrand WHERE tblproduct.BrandID = tblbrand.BrandID AND tblbrand.BrandName='$related_products' AND tblproduct.ProductID != '$_GET[ProductID]' ";
$query_relatedProc = mysqli_query($mysqli, $sql_relatedProc);

while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>

	<div class="product-simple-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="single-product-image">
						<div class="single-product-tab">

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<?php
								$sql_imgPro = "SELECT * FROM tblimage where tblimage.ProductID='$_GET[ProductID]'";
								$query_imgPro = mysqli_query($mysqli, $sql_imgPro);
								$count = 0;
								while ($row = mysqli_fetch_array($query_imgPro)) {
									$count++;
								?>
									<li role="presentation">
										<a href="#sp<?php echo $count ?>" aria-controls="sp<?php echo $count ?>" role="tab" data-toggle="tab">
											<img alt="" src="admin/modules/productManagement/uploads/<?php echo $row['Image'] ?>" style="border-radius: 10px;">
										</a>
									</li>
								<?php }
								?>
							</ul>

							<div class="tab-content">
								<?php
								$sql_imgPro = "SELECT * FROM tblimage where tblimage.ProductID='$_GET[ProductID]'";
								$query_imgPro = mysqli_query($mysqli, $sql_imgPro);
								$count = 0;
								$active = "active";
								while ($row = mysqli_fetch_array($query_imgPro)) {
									$count++;
								?>
									<div role="tabpanel" class="tab-pane <?php echo $active; ?>" id="sp<?php echo $count ?>">
										<img style="object-fit: cover; border-radius: 20px;" src="admin/modules/productManagement/uploads/<?php echo $row['Image'] ?>">
									</div>
								<?php
									$active = "";
								}
								?>
							</div>


						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<form method="POST" action="layout/main/cart/addCart.php?ProductID=<?php echo $row_chitiet['ProductID'] ?>">
						<div class="single-product-info">
							<h1 class="product_title"><?php echo $row_chitiet['ProductName'] ?></h1>
							<div class="price-box">
								<span class="new-price"><?php echo number_format($row_chitiet['Price'], 0, ',', '.') . 'vnđ' ?></span>
							</div>
							<div class="pro-rating">
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
							</div>
							<div class="short-description">
								<p><?php echo $row_chitiet['Description'] ?></p>
							</div>
							<div class="stock-status">
								<label>Loại sản phẩm</label>: <strong><?php echo $row_chitiet['CategoryName'] ?></strong>
							</div>
							<form action="#">
								<div class="quantity">

									<button type="submit" name="addCart">Add to cart</button>
								</div>
							</form>
							<div class="share_buttons">
								<a href="#"><img src="img/share-img.png" alt="" /></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>


<section class="featured-area new-arrival">
	<div class="container">
		<div class="row">
			<div class="text-center">
				<div class="section-titel">
					<h3>Sản phẩm đang sale</h3>
				</div>
			</div>
			<div class="newarrival-area">
				<div id="newarrival-curosel" class="indicator-style">
					<?php
					while ($row_relatedProc = mysqli_fetch_array($query_relatedProc)) {
					?>
						<div class="col-md-12">
							<div class="single-product">
								<div class="product-image">
									<a class="product-img" href="index.php?page=sanpham&ProductID=<?php echo $row_relatedProc['ProductID'] ?>">
										<img class="primary-img" src="admin/modules/productManagement/uploads/<?php echo $row_relatedProc['Image'] ?>">
									</a>
								</div>
								<?php
								if ($row_relatedProc['IsSale'] == 1) {
									echo '
                                    <span class="onsale">
                                        <span class="sale-text">Sale </span>
                                    </span>';
								} else {
									echo "";
								}
								?>
								<div class="product-action">
									<h4><a href="index.php?page=sanpham&ProductID=<?php echo $row_relatedProc['ProductID'] ?>"><?php echo $row_relatedProc['ProductName'] ?></a></h4>
									<ul class="pro-rating">
										<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
										<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
										<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
									</ul>
									<span class="price"><?php echo number_format($row_relatedProc['Price'], 0, ',', '.') . 'vnđ' ?></span>
								</div>

							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- PRODUCT TAB AREA START -->
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