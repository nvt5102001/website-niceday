<?php
$sql_sua_thuonghieu = "SELECT * FROM tblbrand WHERE BrandID='$_GET[BrandID]' LIMIT 1";
$query_sua_thuonghieu = mysqli_query($mysqli, $sql_sua_thuonghieu);
?>


<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="card-body-header">
							<h4 class="card-title">Cập nhật thương hiệu</h4>
							<button class="btn btn-outline-dark btn-icon-text">
								<i class="mdi mdi-arrow-left"></i>
								<a href="index.php?action=brandManagement&query=select">Quay lại</a>
							</button>
						</div>
						<div class="table-responsive pt-3">
							<table class="table table-light">
								<form method="POST" action="modules/brandManagement/handle.php?BrandID=<?php echo $_GET['BrandID'] ?>">
									<?php
									while ($dong = mysqli_fetch_array($query_sua_thuonghieu)) {
									?>
										<tr>
											<td class='table-title'>Tên thương hiệu</td>
											<td><input type="text" value="<?php echo $dong['BrandName'] ?>" name="BrandName"></td>
										</tr>
										<tr>
											<td colspan="2">
												<button type="submit" name="suathuonghieu" class="btn btn-outline-dark btn-icon-text">
													Sửa
													<i class="ti-file btn-icon-append"></i>
												</button>
											</td>
										</tr>
									<?php
									}
									?>

								</form>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>