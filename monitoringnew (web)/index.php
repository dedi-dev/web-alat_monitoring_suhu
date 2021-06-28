	<html>
	<head>
		<script src="jquery-latest.js"></script>
	<script>
	var refreshId = setInterval(function()
	{
	$('#responsecontainer').load('home.php');
	}, 5000);
	</script>
	<?php 
	session_start();
  if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
  }
   ?>
	</head>
	<body>
	<div id="responsecontainer">
	</div>
	</body>
	</html>
