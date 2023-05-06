<?php
$sql_sua_sp = "SELECT * FROM tblproduct WHERE ProductID ='$_GET[ProductID]' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);
?>

<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="card-body-header">
							<h4 class="card-title">Cập nhật sản phẩm</h4>
							<button class="btn btn-outline-dark btn-icon-text">
								<i class="mdi mdi-arrow-left"></i>
								<a href="index.php?action=productManagement&query=select">Quay lại</a>
							</button>
						</div>
						<div class="table-responsive pt-3">
							<table class="table table-light">

								<?php
								while ($row = mysqli_fetch_array($query_sua_sp)) {
								?>
									<form method="POST" action="modules/productManagement/handle.php?ProductID=<?php echo $row['ProductID'] ?>" enctype="multipart/form-data">
										<tr>
											<td>Tên sản phẩm</td>
											<td><input type="text" value="<?php echo $row['ProductName'] ?>" name="ProductName"></td>
										</tr>
										<tr>
											<td>Loại sản phẩm</td>
											<td>
												<select name="loaisp">
													<?php
													$sql_loaisp = "SELECT * FROM tblcategory ORDER BY CategoryID DESC";
													$query_loaisp = mysqli_query($mysqli, $sql_loaisp);
													while ($row_loaisp = mysqli_fetch_array($query_loaisp)) {
														if ($row_loaisp['CategoryID'] == $row['CategoryID']) {
													?>
															<option selected value="<?php echo $row_loaisp['CategoryID'] ?>"><?php echo $row_loaisp['CategoryName'] ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $row_loaisp['CategoryID'] ?>"><?php echo $row_loaisp['CategoryName'] ?></option>
													<?php
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Thương hiệu sản phẩm</td>
											<td>
												<select name="thuonghieu">
													<?php
													$sql_thuonghieu = "SELECT * FROM tblbrand ORDER BY BrandID DESC";
													$query_thuonghieu = mysqli_query($mysqli, $sql_thuonghieu);
													while ($row_thuonghieu = mysqli_fetch_array($query_thuonghieu)) {
														if ($row_thuonghieu['BrandID'] == $row['BrandID']) {
													?>
															<option selected value="<?php echo $row_thuonghieu['BrandID'] ?>"><?php echo $row_thuonghieu['BrandName'] ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $row_thuonghieu['BrandID'] ?>"><?php echo $row_thuonghieu['BrandName'] ?></option>
													<?php
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Màu sắc sản phẩm</td>
											<td>
												<select name="color">
													<?php
													$sql_color = "SELECT * FROM tblcolor ORDER BY ColorID DESC";
													$query_color = mysqli_query($mysqli, $sql_color);
													while ($row_color = mysqli_fetch_array($query_color)) {
														if ($row_color['ColorID'] == $row['ColorID']) {
													?>
															<option selected value="<?php echo $row_color['ColorID'] ?>"><?php echo $row_color['ColorName'] ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $row_color['ColorID'] ?>"><?php echo $row_color['ColorName'] ?></option>
													<?php
														}
													}
													?>
												</select>
											</td>
										</tr>

										<tr>
											<td>Kiểu dáng sản phẩm</td>
											<td>
												<select name="style">
													<?php
													$sql_style = "SELECT * FROM tblstyle ORDER BY StyleID DESC";
													$query_style = mysqli_query($mysqli, $sql_style);
													while ($row_style = mysqli_fetch_array($query_style)) {
														if ($row_style['StyleID'] == $row['StyleID']) {
													?>
															<option selected value="<?php echo $row_style['StyleID'] ?>"><?php echo $row_style['StyleName'] ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $row_style['StyleID'] ?>"><?php echo $row_style['StyleName'] ?></option>
													<?php
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Số lượng</td>
											<td><input type="text" value="<?php echo $row['Quantity'] ?>" name="Quantity"></td>
										</tr>
										<tr>
											<td>Giá mua</td>
											<td><input type="text" value="<?php echo $row['ImportPrice'] ?>" name="ImportPrice"></td>
										</tr>
										<tr>
											<td>Giá bán</td>
											<td><input type="text" value="<?php echo $row['Price'] ?>" name="Price"></td>
										</tr>
										<tr>
											<td>Hình ảnh</td>
											<td>
												<input type="file" name="Image">
												<img src="modules/productManagement/uploads/<?php echo $row['Image'] ?>" width="150px">
											</td>
										</tr>
										<tr>
											<td>Mô tả</td>
											<td><textarea rows="10" cols="50" name="Description" style="resize: none"><?php echo $row['Description'] ?></textarea></td>
										</tr>
										<tr>
											<td>Độ hot</td>
											<td>
												<select name="IsHot">
													<option value="0" <?php if ($row['IsHot'] == 0) echo 'selected'; ?>>Không</option>
													<option value="1" <?php if ($row['IsHot'] == 1) echo 'selected'; ?>>Có</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Thời gian bảo hành</td>
											<td><input type="text" value="<?php echo $row['WarrantyPeriod'] ?>" name="WarrantyPeriod"></td>
										</tr>
										<tr>
											<td>Phí vận chuyển</td>
											<td><input type="text" value="<?php echo $row['TransportFee'] ?>" name="TransportFee"></td>
										</tr>
										<tr>
											<td>Sale (%)</td>
											<td><input type="text" value="<?php echo $row['SalePercent'] ?>" name="SalePercent"></td>
										</tr>
										<tr>
											<td>Sale</td>
											<td>
												<select name="IsSale">
													<option value="0" <?php if ($row['IsSale'] == 0) echo 'selected'; ?>>Không</option>
													<option value="1" <?php if ($row['IsSale'] == 1) echo 'selected'; ?>>Có</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2"><button type="submit" name="updatesanpham" class="btn btn-outline-dark btn-icon-text">
													Sửa
													<i class="ti-file btn-icon-append"></i>
												</button></td>
										</tr>
									</form>
								<?php
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>