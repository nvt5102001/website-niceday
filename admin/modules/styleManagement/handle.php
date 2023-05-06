<?php
include('../../config/config.php');

$StyleName = $_POST['StyleName'];
if(isset($_POST['themstyle'])){
	//them
	$sql_them = "INSERT INTO tblstyle(StyleName) VALUE('".$StyleName."')";
	mysqli_query($mysqli,$sql_them);
	header('Location:../../index.php?action=styleManagement&query=select');
}elseif(isset($_POST['suastyle'])){
	//sua
	$sql_update = "UPDATE tblstyle SET StyleName ='".$StyleName."' WHERE StyleID='$_GET[StyleID]'";
	mysqli_query($mysqli,$sql_update);
	header('Location:../../index.php?action=styleManagement&query=select');
}else{

	$id=$_GET['StyleID'];
	$sql_xoa = "DELETE FROM tblstyle WHERE StyleID='".$id."'";
	mysqli_query($mysqli,$sql_xoa);
	header('Location:../../index.php?action=styleManagement&query=select');
}
