<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
	unset($_SESSION['Gmail']);
	unset($_SESSION['dangky']);
	unset($_SESSION['dangnhap']);
}
?>




<div class="menu-area">
	<div class="container">
		<div class="header__menu">
			<div class="header__left ">
				<div>
					<ul class="">
						<li <?php if (isset($_GET['page'])) {
								echo '';
							} else {
								echo 'class="menu-active"';
							}
							?>><a href="index.php">Trang chủ</a></li>
						<li <?php if (isset($_GET['page']) && $_GET['page'] == 'shop') echo 'class="menu-active"'; ?>><a href="index.php?page=shop">Sản phẩm</a></li>
						<li <?php if (isset($_GET['page']) && $_GET['page'] == 'about') echo 'class="menu-active"'; ?>><a href="index.php?page=about">Về NICEDAY</a></li>
						<li <?php if (isset($_GET['page']) && $_GET['page'] == 'blog') echo 'class="menu-active"'; ?>><a href="index.php?page=blog">Blog</a></li>
						<li <?php if (isset($_GET['page']) && $_GET['page'] == 'contact') echo 'class="menu-active"'; ?>><a href="index.php?page=contact">Liên hệ</a></li>

					</ul>
				</div>
			</div>

			<div class="header__center">
				<div class="logo-area">
					<a href="index.html"><img src="img/home-1/logo.png" alt="" /></a>
				</div>
			</div>



			<div class="header__right">
				<div class="header__right">
					<div class="header__search">
						<form action="index.php?page=timkiem" method="POST">
							<input type="text" id="searchKey" placeholder="Search..." name="tukhoa">
							<button class="search-button" name="timkiem" type="submit">
								<div class="icon icon-search icon-24"></div>
							</button>
						</form>
					</div>
					<div class="header__icon">
						<a href="index.php?page=giohang"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
						<?php
						if (isset($_SESSION['Gmail'])) {
						?>
							<div class="totalInCart">
								<span>
									<?php
									if (isset($_SESSION['totalProductInCart'])) {
										echo $_SESSION['totalProductInCart'];
									}
									else
									{
										echo 0;
									}
									?></span>
							</div>
						<?php } ?>
					</div>
					<div class="header__icon">
						<a href="index.php?page=login"><i class="fa fa-user" aria-hidden="true"></i></a>
					</div>
					<div><span><a href="index.php?dangxuat=1" style="color:#fff;">LOG OUT</a></span></div>
				</div>
			</div>
		</div>
	</div>
</div>