<?php
include('../../config/config.php');

$ColorName = $_POST['ColorName'];
//xuly hinh anh
$ImageColor = $_FILES['ImageColor']['name'];
$ImageColor_tmp = $_FILES['ImageColor']['tmp_name'];
$ImageColor = time().'_'.$ImageColor;

if(isset($_POST['themcolor'])){
	//them
	$sql_them = "INSERT INTO tblcolor(ColorName,ImageColor) VALUE('".$ColorName."','".$ImageColor."')";
	mysqli_query($mysqli,$sql_them);

	move_uploaded_file($ImageColor_tmp,'uploads/'.$ImageColor);
	header('Location:../../index.php?action=colorManagement&query=select');
}elseif(isset($_POST['suacolor'])){
	//sua
	if(!empty($_FILES['ImageColor']['name'])){
		move_uploaded_file($ImageColor_tmp,'uploads/'.$ImageColor);
		$sql_update = "UPDATE tblcolor SET ColorName ='".$ColorName."', ImageColor ='".$ImageColor."' WHERE ColorID='$_GET[ColorID]'";
		
		//xoa hinh anh cu
		$sql = "SELECT * FROM tblcolor WHERE ColorID = '$_GET[ColorID]' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);

		while($row = mysqli_fetch_array($query)){
			unlink('uploads/'.$row['ImageColor']);
		}
	}
	else
	{
		$sql_update = "UPDATE tblcolor SET ColorName ='".$ColorName."' WHERE ColorID='$_GET[ColorID]'";
	}
	mysqli_query($mysqli,$sql_update);
	header('Location:../../index.php?action=colorManagement&query=select');
}else{

	$id=$_GET['ColorID'];
	$sql_xoa = "DELETE FROM tblcolor WHERE ColorID='".$id."'";
	mysqli_query($mysqli,$sql_xoa);
	header('Location:../../index.php?action=colorManagement&query=select');
}
