<?php
    include('../../../admin/config/config.php');
	if(isset($_GET['code'])){
		$code_cart = $_GET['code'];
		$sql_update ="UPDATE tblretail_invoice SET Status = 2 WHERE ReInvoiceID='".$code_cart."'";
		$query = mysqli_query($mysqli,$sql_update);

        header('Location:../../../index.php?page=orderHistory');
	}     
?>