<!DOCTYPE html>
<html>
<head>
	<title>代码长度统计</title>
	<link rel="stylesheet" type="text/css" href="sheet.css">
	<meta charset="utf-8">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	
	<!-- styles -->
	<link href="./src/jquery.fileuploader.css" media="all" rel="stylesheet">
	<link href="css/jquery.fileuploader-theme-onebutton.css" media="all" rel="stylesheet">
	
	<!-- js -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
	<script src="./src/jquery.fileuploader.min.js" type="text/javascript"></script>
	<script src="./js/custom.js" type="text/javascript"></script>
</head>
<body scroll="no">
	<div style="position: absolute;top: 20%;left: 20%;width:60%;color: white;font-size: 50px;text-align: center;">
	<?php
		$con = mysqli_connect("localhost","root","","code_length");
		if(!$con)
			die("connect failed" . mysqli_connect_error());
		$sql = "SELECT * FROM `user` WHERE `name` = 'licong'";
		$query = mysqli_query($con,$sql);
		$result = mysqli_fetch_array($query);
		$length = $result['length'];
		echo $length;
	?>
	</div>
	<div id="form">
		<br>
		<form action="./form_upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="files">
			<input type="submit" class="button">
		</form>
	</div>
</body>
</html>