<?php
    session_start();
    require('../../../carbon/autoload.php');
    include('../../config/config.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    
    $tkncc = $_POST['tkncc'];
    $Status = $_POST['Status'];
    // $ImportDate = $_POST['ImportDate'];
    $tknv = $_POST['tknv'];
    $DeliverPhone = $_POST['DeliverName'];
    $DeliverName = $_POST['DeliverName'];
        
    $now = Carbon::now('Asia/Ho_Chi_Minh');
    $tongtien =  $_SESSION['tongtien_pnk'];

    // Thêm hoá đơn nhập
    $insert_ctPNK = "INSERT INTO tblimport_invoice(ImportDate,EmployeeAccID ,SupplierAccID,Status,TotalMoney,DeliverName,DeliverPhone) VALUE('".$now."','".$tknv."','".$tkncc."','".$Status."','".$tongtien."','".$DeliverName."','".$DeliverPhone."')";
    $ctPNK_query = mysqli_query($mysqli,$insert_ctPNK);
    $ImDetailID = mysqli_insert_id($mysqli);
    if($ctPNK_query){
        //them chi tiết hoá đơn nhập
        foreach($_SESSION['ctPNK'] as $key => $value){
            $id_sanpham = $value['id'];
            $soluong = $value['QuantityImOrder'];

            // Thêm chi tiết hoá đơn nhập
            $insert_order_details = "INSERT INTO tblimport_invoice_detail(ProductID,ImInvoiceID,QuantityImOrder) VALUE('".$id_sanpham."','".$ImDetailID."','".$soluong."')";
            mysqli_query($mysqli,$insert_order_details);

            // Thêm số lượng sản phẩm đã có
            $lietke_soluong_sp = "SELECT * FROM tblproduct,tblimport_invoice_detail WHERE tblproduct.ProductID = '$id_sanpham' AND tblimport_invoice_detail.ProductID = '$id_sanpham' AND tblproduct.ProductID = tblimport_invoice_detail.ProductID ";
			$row = mysqli_query($mysqli,$lietke_soluong_sp);
			$row_data = mysqli_fetch_array($row);

			$soluongNew = $row_data['Quantity'] + $soluong;

			$sql_update_slsp = "UPDATE tblproduct SET Quantity = '$soluongNew' WHERE ProductID = '$id_sanpham'";
			mysqli_query($mysqli,$sql_update_slsp);

        }    
    }

    // Chuyển chưa thanh toán -> đã thanh toán
    $code_cart = $_GET['code'];
    $sql_update ="UPDATE tblimport_invoice SET Status= 0 WHERE ImInvoiceID='".$code_cart."'";
    $query = mysqli_query($mysqli,$sql_update);

    // Xoá hoá đơn
    $code_cart = $_GET['ImInvoiceID'];
    $sql_xoa_cthd = "DELETE FROM tblimport_invoice_detail WHERE ImInvoiceID='".$code_cart."'";
    mysqli_query($mysqli,$sql_xoa_cthd);
    $sql_xoa_hd = "DELETE FROM tblimport_invoice WHERE ImInvoiceID='".$code_cart."'";
    mysqli_query($mysqli,$sql_xoa_hd);

    unset($_SESSION['ctPNK']);
    header('Location:../../index.php?action=warehouseManagement&query=select');
