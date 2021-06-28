<?php
date_default_timezone_set("Asia/Jakarta");
      include "koneksi.php"; 
	  
	$temperature = $_GET['temp'];
	$humidity = $_GET['hum'];
	$fan = $_GET['fan'];
	$datenow = $now ->format("Y-m-d H:i:s");


if ($fan == '1') {
 	$kipas = "Putaran Penuh";
}
else {
  $kipas = "Putaran Sedang"; 
}

if ($temperature <='0' ){
	$keterangansuhu = "Sensor Error";
}
else if ($temperature <='17' ){
	$keterangansuhu = "Suhu Dingin";
}
else if ($temperature <='25' ){
	$keterangansuhu = "Suhu Normal";
}
else if ($temperature <='29' ){
	$keterangansuhu = "Suhu Panas";
}
else if ($temperature >='30' ){
	$keterangansuhu = "Suhu Overheat";
}

if ($humidity <='0' ){
	$keteranganudara = "Sensor Error";
}
else if ($humidity <='39' ){
	$keteranganudara = "Udara Kering";
}
else if ($humidity <='79' ){
	$keteranganudara = "Udara Normal";
}
else if ($humidity <='90' ){
	$keteranganudara = "Udara Lembab";
}
else if ($humidity >='91' ){
	$keteranganudara = "Terlalu Lembab";
}

$sql = "INSERT INTO `suhukelembaban`(`tanggalwaktu`,`suhu`, `kelembaban`, `kipas`,`kondisisuhu`,`kondisiudara`) 
						VALUES(\"$datenow\",\"$temperature\",\"$humidity\",\"$kipas\",\"$keterangansuhu\",\"$keteranganudara\")";
$result = mysqli_query($connect_db ,$sql);
if (!$result) {
die('Invalid query: ' .
mysqli_error($connect_db));
}echo "<h1>Data Terkirim</h1>";
?>