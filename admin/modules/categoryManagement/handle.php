<?php
include('../../config/config.php');

$CategoryName = $_POST['CategoryName'];
if(isset($_POST['themloai'])){
	//them
	$sql_them = "INSERT INTO tblcategory(CategoryName) VALUE('".$CategoryName."')";
	mysqli_query($mysqli,$sql_them);
	header('Location:../../index.php?action=categoryManagement&query=insert');
}elseif(isset($_POST['sualoai'])){
	//sua
	$sql_update = "UPDATE tblcategory SET CategoryName='".$CategoryName."' WHERE CategoryID='$_GET[CategoryID]'";
	mysqli_query($mysqli,$sql_update);
	header('Location:../../index.php?action=categoryManagement&query=insert');
}else{

	$id=$_GET['CategoryID'];
	$sql_xoa = "DELETE FROM tblcategory WHERE CategoryID='".$id."'";
	mysqli_query($mysqli,$sql_xoa);
	header('Location:../../index.php?action=categoryManagement&query=insert');
}

?>