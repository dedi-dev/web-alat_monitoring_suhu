<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login Monitoring Suhu dan kelembaban</title>
<link href="Scriptstyle.css" rel="stylesheet" type="text/css"/>
</head>
<?php
  if(isset($_GET['pesan'])){
    if($_GET['pesan'] == "gagal"){
      echo "Login gagal! username dan password salah!";
    }else if($_GET['pesan'] == "logout"){
      echo "Anda telah berhasil logout";
    }else if($_GET['pesan'] == "belum_login"){
      echo "Anda harus login untuk mengakses halaman Sistem Monitoring";
    }
  }
  ?>
<body>
<table width="820" border="0" align="center">
  <tbody>
    <tr>
      <td align="center" valign="middle" bgcolor="#B0ACAC"> <center>
       Login Sistem Monitoring Suhu dan kelembaban Ruangan Kantor CV. AABC SOFTWARE  
      </center></td>
    </tr>
  </tbody>
</table>
<div>
  
  <br/>
  <br/>
  <form method="post" action="cek_login.php">
    <table width="820" border="0" align="center">
      <tr>
        <td>Username</td>
        <td>:</td>
        <td><input type="text" name="username" placeholder="Masukan username"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td>:</td>
        <td><input type="password" name="password" placeholder="Masukkan password"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><input type="submit" value="LOGIN"></td>
      </tr>
      <tr height="400">
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>      
  </form>
</div>
<p>&nbsp; </p>
<div id="footer" align="center">
        &copy;2018 <a href="mailto:dedi.id@yahoo.com">Dedi</a> |
Design By <a href="#">Dedi</a>
</div>
</body>
</html>