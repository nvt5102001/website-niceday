<?php
	session_start();
	include('../../../admin/config/config.php');
	// $_SESSION['totalProductInCart'] = 0;
	//them so luong
	if(isset($_GET['cong'])){
		$id=$_GET['cong'];
		
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$cart_item['Quantity'],'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
				$_SESSION['cart'] = $product;
			}else{
				$tangsoluong = $cart_item['Quantity'] + 1;
				if($cart_item['Quantity']<=9){
					
					$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$tangsoluong,'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
				}else{
					$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$cart_item['Quantity'],'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
				}
				$_SESSION['cart'] = $product;
			}
			
		}
		$_SESSION['totalProductInCart']++;		
		header('Location:../../../index.php?page=giohang');
	}
	//tru so luong
	if(isset($_GET['tru'])){
		$id=$_GET['tru'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$cart_item['Quantity'],'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
				$_SESSION['cart'] = $product;
			}else{
				$tangsoluong = $cart_item['Quantity'] - 1;
				if($cart_item['Quantity']>1){
					
					$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$tangsoluong,'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
				}else{
					$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$cart_item['Quantity'],'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
				}
				$_SESSION['cart'] = $product;
			}	
		}
		$_SESSION['totalProductInCart']--;
		header('Location:../../../index.php?page=giohang');
	}
	//xoa san pham
	if(isset($_SESSION['cart'])&&isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		$slxoa = 0;
		foreach($_SESSION['cart'] as $key => $cart_item){
			if($cart_item['id']!=$id){
				$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$cart_item['Quantity'],'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
			}
			elseif ($cart_item['id']==$id)
			{
				$slxoa = $cart_item['Quantity'];
			}
			$_SESSION['cart'] = $product;
			header('Location:../../../index.php?page=giohang');
		}
		$_SESSION['totalProductInCart'] -= $slxoa;
		if($_SESSION['totalProductInCart'] <= 0)
		{
			$_SESSION['totalProductInCart'] = 0;
		}
	}
	//xoa tat ca
	if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
		unset($_SESSION['cart']);
		$_SESSION['totalProductInCart'] = 0;
		header('Location:../../../index.php?page=giohang');
	}
	//them sanpham vao gio hang
	if(isset($_POST['addCart'])){
		// session_destroy();
		$id=$_GET['ProductID'];
		$SoLuong=1;
		$sql ="SELECT * FROM tblproduct WHERE ProductID='".$id."' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);
		$row = mysqli_fetch_array($query);
		if($row){
			$new_product=array(array('ProductName'=>$row['ProductName'],'id'=>$id,'Quantity'=>$SoLuong,'Price'=>$row['Price'],'Image'=>$row['Image']));
			//kiem tra session gio hang ton tai
			if(isset($_SESSION['cart'])){
				$found = false;
				foreach($_SESSION['cart'] as $cart_item){
					//neu du lieu trung
					if($cart_item['id']==$id){
						$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$SoLuong+1,'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
						$found = true;
					}else{
						//neu du lieu khong trung
						$product[]= array('ProductName'=>$cart_item['ProductName'],'id'=>$cart_item['id'],'Quantity'=>$cart_item['Quantity'],'Price'=>$cart_item['Price'],'Image'=>$cart_item['Image']);
					}
				}
				if($found == false){
					//lien ket du lieu new_product voi product
					$_SESSION['cart']=array_merge($product,$new_product);
				}else{
					$_SESSION['cart']=$product;
				}
			}else{
				$_SESSION['cart'] = $new_product;
			}
			$_SESSION['totalProductInCart'] += 1;
		}
		header('Location:../../../index.php?page=giohang');
		
	}
