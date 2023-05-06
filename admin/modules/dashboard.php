<div class="main-panel">
	<div class="content-wrapper">
		<div class="statistics">
			<div class="header__statistics">
				<h1 class="title-statistics">Tổng quan</h1>
				<div class="btn-wrapper exports">
					<button class="btn btn-primary text-white me-0" onclick="showExports()"><i class="icon-download"></i> Export</button>
					<div class="export-child" id="export-child">
						<form method="POST" action="modules/export/export.php">
							<button type="submit" name="export_excel">Xuất Excel theo ngày</button>
						</form>
						<form method="POST" action="modules/export/exportByMonth.php">
							<button type="submit" name="export_excel">Xuất Excel theo tháng</button>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="statistics-details d-flex align-items-center justify-content-between">
						<?php

						$sql = "SELECT SUM(Revenue) as totalMoney, 
						SUM(TotalInvoice) as totalOrder,
						SUM(TotalProduct) as totalProduct
						 FROM tblstatistical";
						$query = mysqli_query($mysqli, $sql);
						while ($row = mysqli_fetch_array($query)) {
						?>
							<div>
								<p class="statistics-title">Tổng doanh thu (VNĐ)</p>
								<h3 class="rate-percentage"><?php echo number_format($row['totalMoney'], 0, ',', '.') ?></h3>
							</div>
							<div>
								<p class="statistics-title">Tổng hoá đơn</p>
								<h3 class="rate-percentage"><?php echo $row['totalOrder'] ?></h3>
							</div>
							<div>
								<p class="statistics-title">Tổng sản phẩm bán ra</p>
								<h3 class="rate-percentage"><?php echo $row['totalProduct'] ?></h3>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<div>
				<select class="select-date">
					<option value="7ngay">7 ngày qua</option>
					<option value="28ngay">28 ngày qua</option>
					<option value="90ngay">90 ngày qua</option>
					<option value="365ngay">365 ngày qua</option>
				</select>
			</div>
			<div id="chart" style="height: 250px;"></div>
			<!-- <div id="chartLine" style="height: 250px;"></div> -->
		</div>
	</div>
</div>

<script>
	var exportOps = document.querySelector('#export-child');
	var flag = false;

	function showExports() {
		if (flag == true) {
			exportOps.classList.add('showEl');
		} else {
			exportOps.classList.remove('showEl');
		}
		flag = !flag;
	}
</script>