<?php
include('./admin/config/config.php');
?>
<!-- MENU AREA END -->
<!-- BANNER AREA STRAT -->
<section class="bannerhead-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="banner-heading">
					<h1>Blog</h1>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- MENU AREA END -->
<!-- MAP-AREA START -->



<section class="our-brand-area">
	<div class="container">

		<div style="margin-bottom: 50px; ">
			<div class="text-center">
				<div class="section-titel">
					<h3>Bài viết mới nhất</h3>
				</div>
			</div>
			<div id="features-curosel" class="indicator-style">

				<?php

				$sql_blog = "SELECT * FROM tblblog, tblaccount WHERE tblblog.EmployeeAccID = tblaccount.AccountID";
				$query_blog = mysqli_query($mysqli, $sql_blog);

				while ($row = mysqli_fetch_array($query_blog)) {
				?>

					<div class="col-md-12">
						<div class="single-product blog-card">
							<div style="margin-bottom: 10px;">
								<a href="index.php?page=blogdetail&BlogID=<?php echo $row['BlogID'] ?>">
									<img class="primary-img" src="admin/modules/blogManagement/uploads/<?php echo $row['Image'] ?>" alt="" style="width:231px; height: 145px;" />
								</a>
							</div>
							<h4 class="blog-title"><a href="index.php?page=blogdetail&BlogID=<?php echo $row['BlogID'] ?>"><?php echo $row['BlogTitle'] ?></a></h4>
							<p class="blog-title"><?php echo $row['SummaryContent'] ?></p>
							<div class="product-action" style="line-height: 2;">
								<p style="margin: 0;"><i class="fa fa-user" aria-hidden="true"></i> <span><?php echo $row['AccountName'] ?></span></p>
								<p><i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo date("d/m/Y", strtotime($row['PostDate'])) ?></span></p>
							</div>

						</div>
					</div>
				<?php
				} ?>



			</div>
		</div>


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