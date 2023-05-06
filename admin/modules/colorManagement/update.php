<?php
$sql_sua_color = "SELECT * FROM tblcolor WHERE ColorID='$_GET[ColorID]' LIMIT 1";
$query_sua_color = mysqli_query($mysqli, $sql_sua_color);
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
								<a href="index.php?action=colorManagement&query=select">Quay lại</a>
							</button>
						</div>
						<div class="table-responsive pt-3">
							<table class="table table-light">
								<form method="POST" action="modules/colorManagement/handle.php?ColorID=<?php echo $_GET['ColorID'] ?>" enctype="multipart/form-data">
									<?php
									while ($dong = mysqli_fetch_array($query_sua_color)) {
									?>
										<tr>
											<td>Tên màu</td>
											<td><input type="text" value="<?php echo $dong['ColorName'] ?>" name="ColorName"></td>
										</tr>
										<tr>
											<td>Hình ảnh</td>
											<td>
												<input type="file" name="ImageColor">
												<img src="modules/colorManagement/uploads/<?php echo $dong['ImageColor'] ?>" width="150px">
											</td>

										</tr>
										<tr>
											<td colspan="2">
												<button type="submit" name="suacolor" class="btn btn-outline-dark btn-icon-text">
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