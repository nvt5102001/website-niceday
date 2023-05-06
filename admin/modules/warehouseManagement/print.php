<?php
	require('../../../tfpdf/tfpdf.php');
	require('../../config/config.php');

	$pdf = new tFPDF();
	$pdf->AddPage("0");
	$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
	$pdf->SetFont('DejaVu','',15);
	
	$pdf->SetFillColor(193,229,252);
	//set header 

	$code = $_GET['code'];
	$sql_lietke_dh = "SELECT * FROM tblimport_invoice_detail,tblproduct WHERE tblimport_invoice_detail.ProductID = tblproduct.ProductID AND tblimport_invoice_detail.ImInvoiceID ='".$code."' ORDER BY tblimport_invoice_detail.ImDetailID DESC";
	$query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);

	$sql_lietke_kh = "SELECT * FROM tblimport_invoice,tblaccount WHERE tblimport_invoice.SupplierAccID = tblaccount.AccountID AND tblimport_invoice.ImInvoiceID = '".$code."' ORDER BY tblimport_invoice.ImInvoiceID  DESC";
	$query_lietke_kh = mysqli_query($mysqli,$sql_lietke_kh);
	$row_data = mysqli_fetch_array($query_lietke_kh);

	$pdf->Image('../../images/logo.png',10,5);
	$pdf->Cell(0,0,'HOÁ ĐƠN NHẬP KHO',0,0,'C');
	$pdf->Ln(20);

	$pdf->Write(10,"Mã hoá đơn: ".$row_data['ImInvoiceID']."");
	$pdf->Ln(10);
	$pdf->Write(10,"Ngày đặt: ".$row_data['ImportDate']."");
	$pdf->Ln(20);

	$pdf->Write(10,"Tên nhà cung cấp: ".$row_data['AccountName']."");
	$pdf->Ln(10);

	$pdf->Write(10,"Gmail: ".$row_data['Gmail']."");
	$pdf->Ln(10);

	$pdf->Write(10,"Số điện thoại: 0".$row_data['PhoneNumber']."");
	$pdf->Ln(10);

	$pdf->Write(10,"Địa chỉ: ".$row_data['Address']."");
	$pdf->Ln(20);

	$width_cell=array(20,35,80,50,50,40);

	$pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
	$pdf->Cell($width_cell[1],10,'Mã hàng',1,0,'C',true);
	$pdf->Cell($width_cell[2],10,'Tên sản phẩm',1,0,'C',true);
	$pdf->Cell($width_cell[3],10,'Số lượng',1,0,'C',true); 
	$pdf->Cell($width_cell[4],10,'Giá',1,0,'C',true);
	$pdf->Cell($width_cell[5],10,'Tổng tiền',1,1,'C',true); 
	$pdf->SetFillColor(235,236,236); 
	$fill=false;
	$i = 0;
	$tongtien = 0;
	while($row = mysqli_fetch_array($query_lietke_dh)){
		$i++;
		$tongtien += ($row['QuantityImOrder']*$row['ImportPrice']);
	$pdf->Cell($width_cell[0],10,$i,1,0,'C',$fill);
	$pdf->Cell($width_cell[1],10,$row['ImInvoiceID'],1,0,'C',$fill);
	$pdf->Cell($width_cell[2],10,$row['ProductName'],1,0,'C',$fill);
	$pdf->Cell($width_cell[3],10,$row['QuantityImOrder'],1,0,'C',$fill);
	$pdf->Cell($width_cell[4],10,number_format($row['ImportPrice']),1,0,'C',$fill);
	$pdf->Cell($width_cell[5],10,number_format($row['QuantityImOrder']*$row['ImportPrice']),1,1,'C',$fill);
	$fill = !$fill;
		
	}
	$pdf->Ln(10);
	$pdf->Write(10,"Tổng tiền: ".$tongtien." VNĐ");
	$pdf->Ln(10);
	$pdf->Write(10,'Cảm ơn bạn đã cung cấp sản phẩm cho chúng tôi.');
	$pdf->Ln(10);

	$pdf->Output();
