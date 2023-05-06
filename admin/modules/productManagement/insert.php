<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="card-body-header">
							<h4 class="card-title">Thêm sản phẩm</h4>
							<button class="btn btn-outline-dark btn-icon-text">
								<i class="mdi mdi-arrow-left"></i>
								<a href="index.php?action=productManagement&query=select">Quay lại</a>
							</button>
						</div>
						<div class="table-responsive pt-3">
							<table class="table table-light">
								<form method="POST" action="modules/productManagement/handle.php" enctype="multipart/form-data">
									<tr>
										<td>Tên sản phẩm <span style="color:red"> (*)</span></td>
										<td><input type="text" name="ProductName"></td>
									</tr>
									<tr>
										<td>Số lượng <span style="color:red"> (*)</span></td>
										<td><input type="number" name="Quantity"></td>
									</tr>
									<tr>
										<td>Giá mua <span style="color:red"> (*)</span></td>
										<td><input type="number" name="ImportPrice"></td>
									</tr>
									<tr>
										<td>Giá bán <span style="color:red"> (*)</span></td>
										<td><input type="number" name="Price"></td>
									</tr>
									<tr>
										<td>Hình ảnh <span style="color:red"> (*)</span></td>
										<td><input type="file" name="Image"></td>
									</tr>
									<tr>
										<td>Loại sản phẩm</td>
										<td>
											<select name="loaisp">
												<?php
												$sql_loaisp = "SELECT * FROM tblcategory ORDER BY CategoryID DESC";
												$query_loaisp = mysqli_query($mysqli, $sql_loaisp);
												while ($row_loaisp = mysqli_fetch_array($query_loaisp)) {
												?>
													<option value="<?php echo $row_loaisp['CategoryID'] ?>"><?php echo $row_loaisp['CategoryName'] ?></option>
												<?php
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
												?>
													<option value="<?php echo $row_thuonghieu['BrandID'] ?>"><?php echo $row_thuonghieu['BrandName'] ?></option>
												<?php
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
												?>
													<option value="<?php echo $row_color['ColorID'] ?>"><?php echo $row_color['ColorName'] ?></option>
												<?php
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
												?>
													<option value="<?php echo $row_style['StyleID'] ?>"><?php echo $row_style['StyleName'] ?></option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>

									<tr>
										<td>Mô tả</td>
										<td><textarea rows="10" cols="50" name="Description" style="resize: none"></textarea></td>
									</tr>
									<tr>
										<td>Độ hot</td>
										<td>
											<select name="IsHot">
												<option value="0">Không</option>
												<option value="1">Có</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Thời gian bảo hành</td>
										<td><input type="text" name="WarrantyPeriod"></td>
									</tr>
									<tr>
										<td>Phí vận chuyển</td>
										<td><input type="text" name="TransportFee"></td>
									</tr>
									<tr>
										<td>Sale (%)</td>
										<td><input type="text" name="SalePercent"></td>
									</tr>
									<tr>
										<td>Sale</td>
										<td>
											<select name="IsSale">
												<option value="0">Không</option>
												<option value="1">Có</option>
											</select>
										</td>
									</tr>

									<tr>
										<td colspan="2"><button type="submit" name="themsanpham" class="btn btn-outline-dark btn-icon-text">
												Thêm
												<i class="ti-file btn-icon-append"></i>
											</button></td>
									</tr>
								</form>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>