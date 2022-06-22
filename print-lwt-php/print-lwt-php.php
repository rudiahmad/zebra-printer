<?php

$name = $_POST["name"];
$alamat = $_POST["alamat"];
$ktp = $_POST["ktp"];
$mob = $_POST["mob"];
$barcode = $_POST["barcode"];
$no = $_POST["no"];
$rt = $_POST["rt"];
$rw = $_POST["rw"];


/*
 * File Allows printing from web interface, simply connects to the Zebra Printer and then pumps data
 * into it which gets printed out.
 */
$dataToWrite = "";
$dataToWrite = $dataToWrite . "^XA";
$dataToWrite = $dataToWrite . "^CFA,30";
$dataToWrite = $dataToWrite . "^FO50,130^FDName^FS";
$dataToWrite = $dataToWrite . "^FO50,170^FDAlamat:^FS";
$dataToWrite = $dataToWrite . "^FO50,210^FDKTP:^FS";
$dataToWrite = $dataToWrite . "^FO50,250^FDMobile:^FS";
$dataToWrite = $dataToWrite . "^CFA,30";
$dataToWrite = $dataToWrite . "^FO200,130^FD" . $name . "^FS";
$dataToWrite = $dataToWrite . "^FO200,170^FD" . $alamat . "^FS";
$dataToWrite = $dataToWrite . "^FO200,210^FD" . $ktp . "^FS";
$dataToWrite = $dataToWrite . "^FO200,250^FD" . $mob . "^FS";
$dataToWrite = $dataToWrite . "^FO600,170^FDNo^FS";
$dataToWrite = $dataToWrite . "^FO700,170^FDRT^FS";
$dataToWrite = $dataToWrite . "^FO600,270^FDRW^FS";
$dataToWrite = $dataToWrite . "^FO700,270^FDNo^FS";
$dataToWrite = $dataToWrite . "^FO590,310^FD" . $no . "^FS";
$dataToWrite = $dataToWrite . "^FO710,310^FD" . $rt . "^FS";
$dataToWrite = $dataToWrite . "^FO710,210^FD" . $rw . "^FS";
$dataToWrite = $dataToWrite . "";
$dataToWrite = $dataToWrite . "^FX Third section with barcode.";			
$dataToWrite = $dataToWrite . "^A1N,30,22^BY2,2,70";
$dataToWrite = $dataToWrite . "^FO230,20^BC^FD" . $barcode . "^FS"; 
$dataToWrite = $dataToWrite . "";
$dataToWrite = $dataToWrite . "^CFB,30";
$dataToWrite = $dataToWrite . "^FO600,210^FD" . $no . "^FS^XZ";

$url = 'http://10.102.8.161/pstprnt';
//$data = array('key1' => 'value1', 'key2' => 'value2');

// use key 'http' even if you send the request to https://...
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => $dataToWrite
	)
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */
}
//var_dump($result);
?>