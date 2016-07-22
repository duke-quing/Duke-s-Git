<html>
<?php 		
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
	$target_dir = "pics/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$uploadOK = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

	$name = $_REQUEST['name'];
	$battery = $_REQUEST['battery'];
	echo "First part okay";
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  	  if($check !== false) {
        	echo "File is an image - " . $check["mime"] . ".";
       		 $uploadOk = 1;
  	  } else {
       		 echo "File is not an image.";
        	 $uploadOk = 0;
    	  }
	echo "File is an image";
	/*Check if file already exists*/
	if (file_exists($target_file)) {
    		echo "Sorry, file already exists.";
    		$uploadOk = 0;
		}
	/*Check file size*/
	if ($_FILES["fileToUpload"]["size"] > 500000) {
    		echo "Sorry, your file is too large.";
    		$uploadOk = 0;
	}
	/*Check if $uploadOk is set to 0 by an error*/
	if ($uploadOk == 0) {	
		echo "Sorry, your file was not uploaded.";
		/*if everything is ok, try to upload file*/
	} else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    	} else {
       	 	echo "Sorry, there was an error uploading your file.";
    		}
	}

/*start creating new file*/
	$newfile = fopen($_POST["name"].".php", "w") or die("UNABLE TO OPEN OR CREATE FILE!");
/*write htmlcode to new file*/
	fwrite($newfile, "<!DOCTYPE html>");
	fwrite($newfile, "<html>");
	fwrite($newfile, "<head>");
	fwrite($newfile, "</head>");
	fwrite($newfile, "<body> <?php include 'header.html';?>");
	/*fwrite($newfile, "<img src=$_FILES['fileToUpload']['name']>");*/
	fwrite($newfile, "</body></html>");
	echo "<h1> YOU WERE SUCCESFUL!! </h1>";
	}
 
?>
</html>