<?php
	session_start();
    include('../../config/config.php');
	
	//xoa san pham
	if(isset($_SESSION['ctPNK'])&&isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		foreach($_SESSION['ctPNK'] as $ctPNK_item){

			if($ctPNK_item['id']!=$id){
				$product[]= array('ProductName'=>$ctPNK_item['ProductName'],'id'=>$ctPNK_item['id'],'QuantityImOrder'=>$ctPNK_item['QuantityImOrder'],'ImportPrice'=>$ctPNK_item['ImportPrice'] );
			}

		$_SESSION['ctPNK'] = $product;
        header('Location:../../index.php?action=warehouseManagement&query=insertDetail');
		}
	}
	//xoa tat ca
	if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
		unset($_SESSION['ctPNK']);
        header('Location:../../index.php?action=warehouseManagement&query=insertDetail');
	}
	//them sanpham vao gio hang
	if(isset($_POST['insert'])){
		// session_destroy();
		$id = $_POST['sp'];
        $QuantityImOrder = $_POST['QuantityImOrder'];
		$sql ="SELECT * FROM tblproduct WHERE ProductID='".$id."' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);
		$row = mysqli_fetch_array($query);
		if($row){
			$new_product=array(array('ProductName'=>$row['ProductName'],'id'=>$id,'QuantityImOrder'=>$QuantityImOrder,'ImportPrice'=>$row['ImportPrice']));
			//kiem tra session gio hang ton tai
			if(isset($_SESSION['ctPNK'])){
				$found = false;
				foreach($_SESSION['ctPNK'] as $ctPNK_item){
					//neu du lieu trung
					if($ctPNK_item['id']==$id){
						$product[]= array('ProductName'=>$ctPNK_item['ProductName'],'id'=>$ctPNK_item['id'],'QuantityImOrder'=>$ctPNK_item['QuantityImOrder'],'ImportPrice'=>$ctPNK_item['ImportPrice']);
						$found = true;
					}else{
						//neu du lieu khong trung
						$product[]= array('ProductName'=>$ctPNK_item['ProductName'],'id'=>$ctPNK_item['id'],'QuantityImOrder'=>$ctPNK_item['QuantityImOrder'],'ImportPrice'=>$ctPNK_item['ImportPrice']);
					}
				}
				if($found == false){
					//lien ket du lieu new_product voi product
					$_SESSION['ctPNK']=array_merge($product,$new_product);
				}else{
					$_SESSION['ctPNK']=$product;
				}
			}else{
				$_SESSION['ctPNK'] = $new_product;
			}

		}
        header('Location:../../index.php?action=warehouseManagement&query=insertDetail');
		
	}
