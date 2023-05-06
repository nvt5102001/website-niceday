<?php
	session_start();
	include('../../../admin/config/config.php');
	require('../../../mail/sendmail.php');
	require('../../../carbon/autoload.php');
    require_once('../vnpay/config_vnpay.php');
	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    
	$now = Carbon::now('Asia/Ho_Chi_Minh');
    $tongtien =  $_SESSION['tongtien'];
	$id_khachhang = $_SESSION['AccountID'];
	$cart_payment = $_POST['payment'];
	//lay id thong tin van chuyen
	$sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM tbltransport WHERE AccountID='$id_khachhang' LIMIT 1");
	$row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
	$id_shipping = $row_get_vanchuyen['TransportID'];

    $insert_cart = "INSERT INTO tblretail_invoice(EmployeeAccID, CustomerAccID, ShipperAccID, Status, TotalMoney, TimeOrder, TransportID) VALUE('6','".$id_khachhang."','7','1','".$tongtien."','".$now."','".$id_shipping."')";
    $cart_query = mysqli_query($mysqli,$insert_cart);
    $IdDD = mysqli_insert_id($mysqli);
    $_SESSION['ReInvoiceID'] = $IdDD;

	if($cart_payment == 'cash'){
	//insert vào đơn hàng
        $update_revoice = "UPDATE tblretail_invoice SET Payment = '$cart_payment' WHERE ReInvoiceID = $IdDD";
        $update_query = mysqli_query($mysqli,$update_revoice);
        if($cart_query){
            //them don hàng chi tiet
            foreach($_SESSION['cart'] as $key => $value){
                $id_sanpham = $value['id'];
                $soluong = $value['Quantity'];
                $price = $value['Price'];
                $insert_order_details = "INSERT INTO tblretail_invoice_detail(ReInvoiceID ,ProductID,QuantityReOrder, PriceReOrder) VALUE('".$IdDD."','".$id_sanpham."','".$soluong."','".$price."')";
                mysqli_query($mysqli,$insert_order_details);
		    }
        }
        $_SESSION['totalProductInCart'] = 0;
        unset($_SESSION['cart']);
        header('Location:../../../index.php?page=camon');
	}
   
    elseif($cart_payment=='vnpay'){

		//thanh toan bang vnpay
		$vnp_TxnRef = $_SESSION['ReInvoiceID']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
		$vnp_OrderInfo = 'Thanh toán đơn hàng đặt tại web';
		$vnp_OrderType = 'billpayment';
		
		$vnp_Amount = $tongtien * 100;
		$vnp_Locale = 'vn';
		$vnp_BankCode = 'NCB';
		$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
		
		$vnp_ExpireDate = $expire;

		$inputData = array(
		    "vnp_Version" => "2.1.0",
		    "vnp_TmnCode" => $vnp_TmnCode,
		    "vnp_Amount" => $vnp_Amount,
		    "vnp_Command" => "pay",
		    "vnp_CreateDate" => date('YmdHis'),
		    "vnp_CurrCode" => "VND",
		    "vnp_IpAddr" => $vnp_IpAddr,
		    "vnp_Locale" => $vnp_Locale,
		    "vnp_OrderInfo" => $vnp_OrderInfo,
		    "vnp_OrderType" => $vnp_OrderType,
		    "vnp_ReturnUrl" => $vnp_Returnurl,
		    "vnp_TxnRef" => $vnp_TxnRef,
		    "vnp_ExpireDate"=>$vnp_ExpireDate
		   
		);

		if (isset($vnp_BankCode) && $vnp_BankCode != "") {
		    $inputData['vnp_BankCode'] = $vnp_BankCode;
		}
		// if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
		//     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
		// }

		//var_dump($inputData);
		ksort($inputData);
		$query = "";
		$i = 0;
		$hashdata = "";
		foreach ($inputData as $key => $value) {
		    if ($i == 1) {
		        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
		    } else {
		        $hashdata .= urlencode($key) . "=" . urlencode($value);
		        $i = 1;
		    }
		    $query .= urlencode($key) . "=" . urlencode($value) . '&';
		}

		$vnp_Url = $vnp_Url . "?" . $query;
		if (isset($vnp_HashSecret)) {
		    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
		    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
		}
		$returnData = array('code' => '00'
		    , 'message' => 'success'
		    , 'data' => $vnp_Url);
		if (isset($_POST['redirect'])) {
            $update_revoice = "UPDATE tblretail_invoice SET Payment =  '$cart_payment' WHERE ReInvoiceID = $IdDD";
            $update_query = mysqli_query($mysqli,$update_revoice);
            if($cart_query){
                //them don hàng chi tiet
                foreach($_SESSION['cart'] as $key => $value){
                    $id_sanpham = $value['id'];
                    $soluong = $value['Quantity'];
                    $price = $value['Price'];
                    $insert_order_details = "INSERT INTO tblretail_invoice_detail(ReInvoiceID ,ProductID,QuantityReOrder, PriceReOrder) VALUE('".$IdDD."','".$id_sanpham."','".$soluong."','".$price."')";
                    mysqli_query($mysqli,$insert_order_details);
                }
            }
				$_SESSION['ReInvoiceID'] = $IdDD;
                $_SESSION['totalProductInCart'] = 0;
                unset($_SESSION['cart']);
		        header('Location: ' . $vnp_Url);
		        die();
		}else{
		    echo json_encode($returnData);
		}
			// vui lòng tham khảo thêm tại code demo
	}
