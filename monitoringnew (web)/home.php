<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Monitoring Suhu dan kelembaban</title>
<link href="Scriptstyle.css" rel="stylesheet" type="text/css"/>
<script src="jquery-latest.js"></script>
</head>
<?php
session_start();
  if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
  }
include "koneksi.php";
?>
<body>
<table width="820" border="0" align="center">
  <tbody>
    <tr >
      <td width="820" align="center"  > <img src="images/header.jpg" width="758" height="200"  alt=""/></td>
    </tr>
  </tbody>
</table>
<table width="820" border="0" align="center">
  <tbody>
    <tr>
      <td align="center" valign="middle" bgcolor="#B0ACAC"> <center>
       Selamat Datang Di Sistem Monitoring Suhu dan kelembaban Ruang Server Kantor CV. AABC SOFTWARE  
      </center></td>
    </tr>
  </tbody>
</table>
<div>
<table width="820" border="0" align="center" id="tabel1">
  <tbody>
     
     
  </tbody>
 
</table>
</div>
<div id="responsecontainer">
  <table width="820" border="0" align="center">
  <tbody>
    <tr>
      <td align="center" valign="middle" bgcolor="#B0ACAC">Tabel Data Detail</td>
    </tr>
  </tbody>
</table>
<table width="820" border="2" align="center" id="tabel">
  <tbody>
    <tr>
      <td width="136" align="center">Tanggal & Jam</td>
      <td width="136" align="center">Temperatur (C)</td>
      <td width="136" align="center">Kelembaban (%)</td>
      <td width="136" align="center">Kipas & Exhaust Fan</td>
      <td width="136" align="center">Suhu</td>
      <td width="136" align="center">Kelembaban</td>
    </tr>
      
      <?php

$query = "select * from suhukelembaban order by id desc LIMIT 20";
$sql= mysqli_query ($connect_db ,$query)
  or die("Error: ".mysqli_error($connect_db));
while ($data = mysqli_fetch_array ($sql)){
	
	echo "
    <tr >
      <td>".$data['tanggalwaktu']."</td>
      <td>".$data['suhu']."</td>
      <td>".$data['kelembaban']."</td>
      <td>".$data['kipas']."</td>
      <td>".$data['kondisisuhu']."</td>
      <td>".$data['kondisiudara']."</td>
    </tr>
	";
}
	?>
  </tbody>
</table>
 <table width="820" border="0" align="center">
  <tr> 
    <td><a href="logout.php">LOGOUT</a></td>
    </tr>
  </table>
</div>
<p>&nbsp; </p>
<div id="footer" align="center">&copy;2018 <a href="mailto:dedi.id@yahoo.com">Dedi</a> |
Design By <a href="#">Dedi</a></div>
</body>
</html>