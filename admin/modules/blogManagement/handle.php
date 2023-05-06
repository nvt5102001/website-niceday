<?php
include('../../config/config.php');
require('../../../carbon/autoload.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$BlogTitle = $_POST['BlogTitle'];
//xuly hinh anh
$Image = $_FILES['Image']['name'];
$Image_tmp = $_FILES['Image']['tmp_name'];
$Image = time() . '_' . $Image;
$SummaryContent = $_POST['SummaryContent'];
$Content = $_POST['Content'];
$employee = $_POST['employee'];


if (isset($_POST['thembaiviet'])) {
	//them
	$sql_them = "INSERT INTO tblblog(BlogTitle,SummaryContent,Content,Image,EmployeeAccID, PostDate) VALUE('" . $BlogTitle . "','" . $SummaryContent . "','" . $Content . "','" . $Image . "','" . $employee . "','" . $now . "')";
	mysqli_query($mysqli, $sql_them);
	move_uploaded_file($Image_tmp, 'uploads/' . $Image);
	header('Location:../../index.php?action=blogManagement&query=select');
} elseif (isset($_POST['suabaiviet'])) {
	//sua
	if (!empty($_FILES['Image']['name'])) {

		move_uploaded_file($Image_tmp, 'uploads/' . $Image);

		$sql_update = "UPDATE tblblog SET BlogTitle='" . $BlogTitle . "', SummaryContent='" . $SummaryContent . "',Content='" . $Content . "', Image='" . $Image . "',PostDate='" . $now . "', EmployeeAccID='" . $employee . "'  WHERE BlogID='$_GET[BlogID]'";

		//xoa hinh anh cu
		$sql = "SELECT * FROM tblblog WHERE BlogID = '$_GET[BlogID]' LIMIT 1";
		$query = mysqli_query($mysqli, $sql);
		while ($row = mysqli_fetch_array($query)) {
			unlink('uploads/' . $row['Image']);
		}
	} else {
		$sql_update = "UPDATE tblblog SET BlogTitle='" . $BlogTitle . "',SummaryContent='" . $SummaryContent . "',Content='" . $Content . "',PostDate='" . $now . "', EmployeeAccID='" . $employee . "' WHERE BlogID='$_GET[BlogID]'";
	}

	mysqli_query($mysqli, $sql_update);
	header('Location:../../index.php?action=blogManagement&query=select');
} else {
	$id = $_GET['BlogID'];
	$sql = "SELECT * FROM tblblog WHERE BlogID = '$id' LIMIT 1";
	$query = mysqli_query($mysqli, $sql);
	while ($row = mysqli_fetch_array($query)) {
		unlink('uploads/' . $row['Image']);
	}
	$sql_xoa = "DELETE FROM tblblog WHERE BlogID='" . $id . "'";
	mysqli_query($mysqli, $sql_xoa);
	header('Location:../../index.php?action=blogManagement&query=select');
}
