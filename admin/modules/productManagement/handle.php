<?php
include('../../config/config.php');
require('../../../carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$ProductName = $_POST['ProductName'];
$loaisp = $_POST['loaisp'];
$thuonghieu = $_POST['thuonghieu'];
$color = $_POST['color'];
$style = $_POST['style'];
$Quantity = $_POST['Quantity'];
$ImportPrice = $_POST['ImportPrice'];
$Price = $_POST['Price'];
//xuly hinh anh
$Image = $_FILES['Image']['name'];
$Image_tmp = $_FILES['Image']['tmp_name'];
$Image = time().'_'.$Image;
$Description = $_POST['Description'];
$IsHot = $_POST['IsHot'];
$WarrantyPeriod = $_POST['WarrantyPeriod'];
$TransportFee = $_POST['TransportFee'];
$SalePercent = $_POST['SalePercent'];
$IsSale = $_POST['IsSale'];


if(isset($_POST['themsanpham'])){
	if(empty($_POST['ProductName']) || empty($_POST['Quantity']) || empty($_POST['ImportPrice']) || empty($_POST['Price']) || empty($_FILES['Image']['name'])) {
		echo "<script>alert('Vui lòng điền đầy đủ thông tin bắt buộc'); window.history.go(-1);</script>";
	} else {
	//thêm sản phẩm
	$sql_them = "INSERT INTO tblproduct(ProductName,BrandID,CategoryID,ColorID,StyleID,Quantity,ImportPrice,Price,Image,Description,IsHot,WarrantyPeriod,TransportFee,SalePercent,IsSale,ModifiedDate) 
	VALUE('".$ProductName."','".$thuonghieu."','".$loaisp."','".$color."','".$style."','".$Quantity."','".$ImportPrice."','".$Price."','".$Image."','".$Description."','".$IsHot."','".$WarrantyPeriod."','".$TransportFee."','".$SalePercent."','".$IsSale."','$now')";
	mysqli_query($mysqli,$sql_them);
	
	$ProductID = mysqli_insert_id($mysqli);

	$sql_themImg = "INSERT INTO tblimage(ProductID,Image) 
	VALUE('".$ProductID."','".$Image."')";
	mysqli_query($mysqli,$sql_themImg);

	move_uploaded_file($Image_tmp,'uploads/'.$Image);
	header('Location:../../index.php?action=productManagement&query=select');
	}
}elseif(isset($_POST['updatesanpham'])){
	//sua
	if(!empty($_FILES['Image']['name'])){
		move_uploaded_file($Image_tmp,'uploads/'.$Image);
		// Cập nhật sản phẩm
		$sql_update = "UPDATE tblproduct SET ProductName='".$ProductName."',BrandID='".$thuonghieu."',CategoryID='".$loaisp."',ColorID='".$color."',StyleID='".$style."',Quantity='".$Quantity."',ImportPrice='".$ImportPrice."',Price='".$Price."',Image='".$Image."',Description='".$Description."',IsHot='".$IsHot."',WarrantyPeriod='".$WarrantyPeriod."',TransportFee='".$TransportFee."',SalePercent='".$SalePercent."',IsSale='".$IsSale."', ModifiedDate='$now' WHERE ProductID='$_GET[ProductID]'";
		// Cập nhật ảnh sản phẩm
		$sql_updateImg = "UPDATE tblimage SET Image='".$Image."' WHERE ProductID='$_GET[ProductID]'";
		
		//xoa hinh anh cu
		$sql = "SELECT * FROM tblproduct WHERE ProductID = '$_GET[ProductID]' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);

		//xoa hinh anh cu
		$sql_img = "SELECT * FROM tblimage WHERE ProductID = '$_GET[ProductID]' LIMIT 1";
		$query_img = mysqli_query($mysqli,$sql_img);

		while($row = mysqli_fetch_array($query)){
			unlink('uploads/'.$row['Image']);
		}
		while($row = mysqli_fetch_array($query_img)){
			unlink('uploads/'.$row['Image']);
		}
	}
	else
	{
		$sql_update = "UPDATE tblproduct SET ProductName='".$ProductName."',BrandID='".$thuonghieu."',CategoryID='".$loaisp."',ColorID='".$color."',StyleID='".$style."',Quantity='".$Quantity."',ImportPrice='".$ImportPrice."',Price='".$Price."',Description='".$Description."',IsHot='".$IsHot."',WarrantyPeriod='".$WarrantyPeriod."',TransportFee='".$TransportFee."',SalePercent='".$SalePercent."',IsSale='".$IsSale."', ModifiedDate='$now' WHERE ProductID='$_GET[ProductID]'";
	}
	mysqli_query($mysqli,$sql_update);
	mysqli_query($mysqli,$sql_updateImg);

	header('Location:../../index.php?action=productManagement&query=select');
}else{
	$id= $_GET['ProductID'];

	$sql_img = "SELECT * FROM tblimage WHERE ProductID = '$id' LIMIT 1";
	$query_img = mysqli_query($mysqli,$sql_img);

	$sql = "SELECT * FROM tblproduct WHERE ProductID = '$id' LIMIT 1";
	$query = mysqli_query($mysqli,$sql);

	

	while($row = mysqli_fetch_array($query_img)){
		unlink('uploads/'.$row['Image']);
	}

	while($row = mysqli_fetch_array($query)){
		unlink('uploads/'.$row['Image']);
	}

	// Xoá ảnh sản phẩm
	$sql_xoaImg = "DELETE FROM tblimage WHERE ProductID='".$id."'";
	mysqli_query($mysqli,$sql_xoaImg);	

	// Xoá sản phẩm
	$sql_xoa = "DELETE FROM tblproduct WHERE ProductID='".$id."'";
	mysqli_query($mysqli,$sql_xoa);

	

	header('Location:../../index.php?action=productManagement&query=select');
}
