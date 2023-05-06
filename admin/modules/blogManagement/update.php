<?php
$sql_sua_blog = "SELECT * FROM tblblog WHERE BlogID='$_GET[BlogID]' LIMIT 1";
$query_sua_blog = mysqli_query($mysqli, $sql_sua_blog);
?>


<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="card-body-header">
							<h4 class="card-title">Cập nhật bài viết</h4>
							<button class="btn btn-outline-dark btn-icon-text">
								<i class="mdi mdi-arrow-left"></i>
								<a href="index.php?action=blogManagement&query=select">Quay lại</a>
							</button>
						</div>
						<div class="table-responsive pt-3">
							<table class="table table-light">

								<?php
								while ($row = mysqli_fetch_array($query_sua_blog)) {
								?>
									<form method="POST" action="modules/blogManagement/handle.php?BlogID=<?php echo $row['BlogID'] ?>" enctype="multipart/form-data">
										<tr>
											<td>Tiêu đề bài viết</td>
											<td><input type="text" value="<?php echo $row['BlogTitle'] ?>" name="BlogTitle"></td>
										</tr>
										<tr>
											<td>Tóm tắt</td>
											<td><textarea rows="10" cols="50" name="SummaryContent" style="resize: none"><?php echo $row['SummaryContent'] ?></textarea></td>
										</tr>
										<tr>
											<td>Nội dung</td>
											<td><textarea rows="10" cols="50" name="Content" style="resize: none"><?php echo $row['Content'] ?></textarea></td>
										</tr>
										<tr>
											<td>Hình ảnh</td>
											<td>
												<input type="file" name="Image">
												<img src="modules/blogManagement/uploads/<?php echo $row['Image'] ?>" width="150px">
											</td>
										</tr>
										<tr>
											<td>Người viết</td>
											<td>
												<select name="employee">
													<?php
													$sql_employee = "SELECT * FROM tblaccount WHERE AccessPermissions = '2'";
													$query_employee = mysqli_query($mysqli, $sql_employee);
													while ($row_employee = mysqli_fetch_array($query_employee)) {
														if ($row_employee['AccountID'] == $row['EmployeeAccID']) {
													?>
															<option selected value="<?php echo $row_employee['AccountID'] ?>"><?php echo $row_employee['AccountName'] ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $row_employee['AccountID'] ?>"><?php echo $row_employee['AccountName'] ?></option>
													<?php
														}
													}
													?>
												</select>
											</td>
										</tr>

										<tr>
											<td colspan="2"><button type="submit" name="suabaiviet" class="btn btn-outline-dark btn-icon-text">
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