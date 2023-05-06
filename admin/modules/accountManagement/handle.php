<?php
include('../../config/config.php');

$Gmail = $_POST['Gmail'];
$AccountName = $_POST['AccountName'];
$Password = md5($_POST['Password']);
$AccessPermissions = $_POST['AccessPermissions'];
$PhoneNumber = $_POST['PhoneNumber'];
$Address = $_POST['Address'];
if(isset($_POST['themtk'])){
	//them
	$sql_them = "INSERT INTO tblaccount(Gmail,AccountName,Password,AccessPermissions,PhoneNumber,Address) VALUE('".$Gmail."','".$AccountName."','".$Password."','".$AccessPermissions."','".$PhoneNumber."','".$Address."')";
	mysqli_query($mysqli,$sql_them);
	header('Location:../../index.php?action=quanlytaikhoan&query=select');
}
