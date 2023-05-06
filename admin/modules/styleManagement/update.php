<?php
$sql_sua_style = "SELECT * FROM tblstyle WHERE StyleID='$_GET[StyleID]' LIMIT 1";
$query_sua_style = mysqli_query($mysqli, $sql_sua_style);
?>


<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="card-body-header">
							<h4 class="card-title">Cập nhật kiểu dáng</h4>
							<button class="btn btn-outline-dark btn-icon-text">
								<i class="mdi mdi-arrow-left"></i>
								<a href="index.php?action=styleManagement&query=select">Quay lại</a>
							</button>
						</div>
						<div class="table-responsive pt-3">
							<table class="table table-light">
								<form method="POST" action="modules/styleManagement/handle.php?StyleID=<?php echo $_GET['StyleID'] ?>">
									<?php
									while ($dong = mysqli_fetch_array($query_sua_style)) {
									?>
										<tr>
											<td class='table-title'>Tên kiểu dáng</td>
											<td><input type="text" value="<?php echo $dong['StyleName'] ?>" name="StyleName"></td>
										</tr>
										<tr>
											<td colspan="2">
												<button type="submit" name="suastyle" class="btn btn-outline-dark btn-icon-text">
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