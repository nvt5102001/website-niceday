<?php 
    include('../../config/config.php');
    $sql = "SELECT MONTH(Time) AS thangdat, SUM(TotalInvoice) AS tongdonhang, SUM(Revenue) AS tongdoanhthu, SUM(TotalProduct) AS tongsoluongban FROM tblstatistical GROUP BY MONTH(Time)";
    $sql_query = mysqli_query($mysqli,$sql);

    // Tạo file Excel mới
	require_once '../../../Classes/PHPExcel.php';
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle('Bang thong ke');

    // Gộp các ô A1 đến E1 thành một ô lớn
    $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');

    // Thiết lập dòng chữ 'Thống kê doanh thu cửa hàng' vào ô gộp A1-E1
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Thống kê doanh thu cửa hàng');

	// Thiết lập tiêu đề cho các cột
	$objPHPExcel->getActiveSheet()->setCellValue('A2', 'STT');
	$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Tháng đặt');
	$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Số Đơn hàng');
	$objPHPExcel->getActiveSheet()->setCellValue('D2', 'Doanh thu(VNĐ)');
	$objPHPExcel->getActiveSheet()->setCellValue('E2', 'Số lượng bán');

	// Đổ dữ liệu vào bảng
	$i = 3;
	while ($row = mysqli_fetch_assoc($sql_query)) {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, '' .($i - 2))
        ->getStyle('A' . $i)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle('A' . $i)
        ->getNumberFormat()
        ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);

        // $thangdat = date('d/m/Y', strtotime($row['thangdat']));
        // $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $thangdat)
        // ->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $row['thangdat'])
        ->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    

        $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $row['tongdonhang'] )
        ->getStyle('C' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $row['tongdoanhthu'])
        ->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $row['tongsoluongban'])
        ->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$i++;
	}

    // Thiết lập border cho toàn bộ bảng
    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
            )
        )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A2:E' . ($i - 1))->applyFromArray($styleArray);

    /// Thiết lập độ rộng cho các cột
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

    // Thiết lập title ở giữa
    $styleTitle = array(
        'font' => array(
            'bold' => true,
            'size' => 20
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleTitle);

    // Thiết lập border cho bảng, header ở giữa
    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
            )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray);
    
    // Thiết lập header có màu sắc
    $headerStyleArray = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'CCCCCC')
        ),
        'font' => array(
            'bold' => true
        )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($headerStyleArray);

    // Định dạng lại cột doanh thu
    $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
    for ($row = 3; $row <= $highestRow; $row++) {
        $doanhThu = $objPHPExcel->getActiveSheet()->getCell('D' . $row)->getValue();
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, number_format($doanhThu, 0, ',', '.' ));
    }

    


	// Thiết lập header cho file Excel và xuất file
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="bang_thong_ke.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
