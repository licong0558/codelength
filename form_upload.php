<?php
    include('./src/class.fileuploader.php');
	
	// initialize FileUploader
    $FileUploader = new FileUploader('files', array(
        'uploadDir' => './uploads/',
        'title' => 'name'
    ));
	
	// call to upload the files
    $data = $FileUploader->upload();
    
    // if uploaded and success
    if($data['isSuccess'] && count($data['files']) > 0) {
        // get uploaded files
        echo "success";
        $uploadedFiles = $data['files'];
    }
    // if warnings
	if($data['hasWarnings']) {
        // get warnings
        $warnings = $data['warnings'];
        
   		echo '<pre>';
        print_r($warnings);
		echo '</pre>';
        exit;
    }
	
	// unlink the files
	// !important only for appended files
	// you will need to give the array with appendend files in 'files' option of the FileUploader
	foreach($FileUploader->getRemovedFiles('file') as $key=>$value) {
		unlink('./uploads/' . $value['name']);
	}
	
	// get the fileList
	$fileList = $FileUploader->getFileList();
	$con = mysqli_connect("localhost","root","","code_length");
	if(!$con)
		die("connect failed" . mysqli_connect_error());
	$sql = "SELECT * FROM `user` WHERE `name` = 'licong'";
	$query = mysqli_query($con,$sql);
	$result = mysqli_fetch_array($query);
	$length = $result['length'];
	foreach ($fileList as $key => $value) {
		$name = $value['name'];
		$code = fopen("./uploads/" . $name,"r");
		while(!feof($code))
		{
			fgets($code);
			$length++;
		}
	fclose($code);
	unlink('./uploads/' . $name);
	}
	
	$sql = "UPDATE `user` SET `length`=$length WHERE name='licong'";
	mysqli_query($con,$sql);
	header("Location: http://localhost/codelength/index.php");
?>