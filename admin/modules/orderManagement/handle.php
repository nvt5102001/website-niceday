<?php
	
    require('../../../carbon/autoload.php');
	include('../../config/config.php');
	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
	if(isset($_GET['code'])){
		$code_cart = $_GET['code'];
		$sql_update ="UPDATE tblretail_invoice SET Status=0 WHERE ReInvoiceID='".$code_cart."'";
		$query = mysqli_query($mysqli,$sql_update);

		//thong ke doanh thu
        $sql_lietke_dh = "SELECT * FROM tblretail_invoice_detail,tblproduct WHERE tblretail_invoice_detail.ProductID=tblproduct.ProductID AND tblretail_invoice_detail.ReInvoiceID='$code_cart' ORDER BY tblretail_invoice_detail.ReDetailID DESC";
        $query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);

        $sql_thongke = "SELECT * FROM tblstatistical WHERE Time='$now'"; 
        $query_thongke = mysqli_query($mysqli,$sql_thongke);

        $soluongmua = 0;
        $doanhthu = 0;
        while($row = mysqli_fetch_array($query_lietke_dh)){
              $soluongmua = $soluongmua +  $row['QuantityReOrder'];
              $thanhtien = $row['PriceReOrder']*$row['QuantityReOrder'];
              $doanhthu += $thanhtien;
        }

        if(mysqli_num_rows($query_thongke)==0){
                $soluongban = $soluongmua;
                $doanhthu = $doanhthu;
                $donhang = 0;
                $sql_update_thongke = mysqli_query($mysqli,"INSERT INTO tblstatistical (Time,TotalProduct,Revenue,TotalInvoice) VALUE('$now','$soluongban','$doanhthu','$donhang')" );
        }else
        {
            while($row_tk = mysqli_fetch_array($query_thongke)){
                $soluongban = $row_tk['TotalProduct'] + $soluongmua;
                $doanhthu = $row_tk['Revenue'] + $doanhthu;
                $donhang = $row_tk['TotalInvoice'] + 1;
                $sql_update_thongke = mysqli_query($mysqli,"UPDATE tblstatistical SET TotalProduct='$soluongban',Revenue='$doanhthu',TotalInvoice='$donhang' WHERE Time='$now'" );
            }
        }
		header('Location:../../index.php?action=orderManagement&query=select');
	}
