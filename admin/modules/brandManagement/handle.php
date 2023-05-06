<?php
include('../../config/config.php');

$BrandName = $_POST['BrandName'];
if(isset($_POST['themthuonghieu'])){
	//them
	$sql_them = "INSERT INTO tblbrand(BrandName) VALUE('".$BrandName."')";
	mysqli_query($mysqli,$sql_them);
	header('Location:../../index.php?action=brandManagement&query=select');
}elseif(isset($_POST['suathuonghieu'])){
	//sua
	$sql_update = "UPDATE tblbrand SET BrandName ='".$BrandName."' WHERE BrandID='$_GET[BrandID]'";
	mysqli_query($mysqli,$sql_update);
	header('Location:../../index.php?action=brandManagement&query=select');
}else{

	$id=$_GET['BrandID'];
	$sql_xoa = "DELETE FROM tblbrand WHERE BrandID='".$id."'";
	mysqli_query($mysqli,$sql_xoa);
	header('Location:../../index.php?action=brandManagement&query=select');
}
