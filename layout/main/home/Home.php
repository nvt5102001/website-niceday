	<!-- MENU AREA END -->
	<!-- SLIDER AREA START -->
	<section class="slider-area-main">
		<!-- slider -->
		<div class="slider-area">
			<div class="bend niceties preview-1">
				<div id="ensign-nivoslider-3" class="slides">
					<img src="img/home-1/slider-1.jpg" alt="" title="#slider-direction-1" />
					<img src="img/home-1/slider-2.jpg" alt="" title="#slider-direction-2" />
					<img src="img/home-1/slider-3.jpg" alt="" title="#slider-direction-3" />
				</div>
				<!-- direction 1 -->
				<div id="slider-direction-1" class="t-cn slider-direction">
					<div class="slider-content t-lfl s-tb slider-1">
						<div class="title-container s-tb-c ">
							<h1 class="title1">Hot Summer</h1>
							<h3 class="title3">Sale up to 50%</h3>
						</div>
					</div>
				</div>
				<!-- direction 2 -->
				<div id="slider-direction-2" class=" slider-direction">
					<div class="slider-content t-lfl s-tb slider-2">
						<div class="title-container s-tb-c">
							<h1 class="title1"></h1>
							<h3 class="title3"></h3>
						</div>
					</div>
				</div>
				<!-- direction 3 -->
				<div id="slider-direction-3" class="slider-direction">
					<div class="slider-content t-lfr s-tb slider-3">
						<div class="title-container s-tb-c">
							<h1 class="title1"></h1>
							<h3 class="title3"></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- slider end-->
	</section>
	<!-- SLIDER AREA END -->
	<!-- BANNER AREA START -->
	<section class="banner-area">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 xs-res-mrbtm">
					<div class="banner-left">
						<a class="promo-link" href="index.php?page=shop">
							<img src="img/home-1/banner-1.jpg" alt="" />
							<h1>MEN’S COLLECTION</h1>
							<span class="promo-hover"></span>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="banner-left-side">
						<a class="mr-btm promo-link" href="index.php?page=shop">
							<img src="img/home-1/banner-2.jpg" alt="" />
							<h1>NEW COLLECTION</h1>
							<span class="sl-btn">SALE</span>
							<div class="promo-hover"></div>
						</a>
						<a class="promo-link xs-res-mrbtm" href="index.php?page=shop">
							<img src="img/home-1/banner-3.jpg" alt="" />
							<h1>BEST MEN’S COLLECTION</h1>
							<span class="sl-btn">SALE</span>
							<div class="promo-hover"></div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 xs-res-mrbtm">
					<div class="banner-right">
						<a class="promo-link" href="index.php?page=shop">
							<img src="img/home-1/banner-4.jpg" alt="" />
							<h1>WOMEN’S COLLECTION</h1>
							<span class="promo-hover"></span>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="banner-right-side">
						<a class="mr-btm promo-link" href="index.php?page=shop">
							<img src="img/home-1/banner-5.jpg" alt="" />
							<h1>NEW COLLECTION</h1>
							<span class="sl-btn">SALE</span>
							<div class="promo-hover"></div>
						</a>
						<a class="promo-link" href="index.php?page=shop">
							<img src="img/home-1/banner-6.jpg" alt="" />
							<h1>WOMEN’S COLLECTION</h1>
							<span class="sl-btn">SALE</span>
							<div class="promo-hover"></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- BANNER AREA END -->
	<!-- FEATURED PRODUCT START -->
	<section class="featured-area">
		<div class="container">
			<div class="row">
				<div class="text-center">
					<div class="section-titel">
						<h3>Sản phẩm đang hot</h3>
					</div>
				</div>
				<div class="tab-content">
					<div id="home" class="tab-pane active">
						<div id="features-curosel" class="indicator-style">
							<?php
							$sql_isHot = "SELECT * from tblproduct where IsHot = 1";
							$query_isHot = mysqli_query($mysqli, $sql_isHot);
							while ($row = mysqli_fetch_array($query_isHot)) {
							?>
								<div class="col-md-12">
									<div class="single-product">
										<div class="product-image">
											<a class="product-img" href="index.php?page=sanpham&ProductID=<?php echo $row['ProductID'] ?>">
												<img class="primary-img" src="admin/modules/productManagement/uploads/<?php echo $row['Image'] ?>" alt="" style="height:280px;" />
											</a>
										</div>
										<?php
										if ($row['IsSale'] == 1) {
											echo '
                                    <span class="onsale">
                                        <span class="sale-text">Sale </span>
                                    </span>';
										} else {
											echo "";
										}
										?>
										<div class="product-action">
											<h4><a href="index.php?page=sanpham&ProductID=<?php echo $row['ProductID'] ?>"><?php echo $row['ProductName'] ?></a></h4>
											<ul class="pro-rating">
												<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
												<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
												<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
											</ul>
											<div style="display:flex;justify-content:space-between;">
												<?php
												if ($row['IsSale'] == 0) {
													echo '<span class="price">' . number_format($row['Price'], 0, ',', '.') . 'vnđ </span>';
												} elseif ($row['IsSale'] == 1) {
													echo '<del><span class="price">' . number_format($row['Price'], 0, ',', '.') . 'vnđ</span></del>';
													$salePrice = number_format($row['Price'] * ((100 - $row['SalePercent']) / 100), 0, ',', '.');
													echo '<span class="price">' . $salePrice . 'vnđ</span>';
												}
												?>
											</div>
										</div>
									</div>
								</div>

							<?php
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- NEW ARRIVALS START -->
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
						$sql_isSale = "SELECT * from tblproduct where IsSale = 1";
						$query_isSale = mysqli_query($mysqli, $sql_isSale);
						while ($row = mysqli_fetch_array($query_isSale)) {
						?>
							<div class="col-md-12">
								<div class="single-product">
									<div class="product-image">
										<a class="product-img" href="index.php?page=sanpham&ProductID=<?php echo $row['ProductID'] ?>">
											<img class="primary-img" src="admin/modules/productManagement/uploads/<?php echo $row['Image'] ?>" alt="" style="height:280px;" />
										</a>
									</div>
									<span class="onsale">
										<span class="sale-text">Sale </span>
									</span>
									<div class="product-action">
										<h4><a href="index.php?page=sanpham&ProductID=<?php echo $row['ProductID'] ?>"><?php echo $row['ProductName'] ?></a></h4>
										<ul class="pro-rating">
											<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
											<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
											<li class="pro-ratcolor"><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
										</ul>
										<div style="display:flex;justify-content:space-between;">
											<del><span class="price"><?php echo number_format($row['Price'], 0, ',', '.') . 'vnđ' ?></span></del>
											<span class="price"><?php echo number_format($row['Price'] * ((100 - $row['SalePercent']) / 100), 0, ',', '.') . 'vnđ' ?></span>
										</div>
									</div>
								</div>
							</div>

						<?php
						} ?>
					</div>
				</div>
			</div>
	</section>
	<!-- NEW ARRIVALS END -->
	<!-- LATEST BLOG AREA START -->
	<section class="latest-blog-area">
		<div class="container">
			<div class="text-center">
				<div class="section-titel">
					<h3>Blog</h3>
				</div>
			</div>
			<div class="row">
				<div class="blog-area">
					<div class="col-md-6 col-sm-12 res-mr-btm xs-res-mrbtm">
						<div class="blog-left">
							<a class="product-image-overlay" href="index.php?page=blog">
								<img src="img/home-1/blog-1.jpg" alt="" />
								<div class="left-content text-center">
									<h1>SHARP STYLE </h1>
									<h3>For this season</h3>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 xs-res-mrbtm">
						<div class="blog-right">
							<a class="product-image-overlay" href="index.php?page=blog">
								<img src="img/home-1/blog-2.jpg" alt="" />
							</a>
							<div class="blog-content">
								<i class="fa fa-book"></i>
								<span>31 January, 2016 By JOHN</span>
								<p>Our autumn 2016 exhibition Shoes: Pleasure and Pain will look at the extremes...</p>
								<a href="index.php?page=blog">READ MORE</a>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="blog-right">
							<div class="blog-content">
								<i class="fa fa-book"></i>
								<span>31 January, 2016 By JOHN</span>
								<p>Our autumn 2016 exhibition Shoes: Pleasure and Pain will look at the extremes...</p>
								<a href="index.php?page=blog">READ MORE</a>
							</div>
							<a class="product-image-overlay" href="index.php?page=blog">
								<img src="img/home-1/blog-3.jpg" alt="" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- LATEST BLOG AREA END -->
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
	<!-- Footer Top Area Start -->