<html>
<head>
<title>File Uploading Form</title>
</head>
<body>
<h3>File Upload:</h3>
Select a file to upload: <br />
<form action="file_upload_diff.php" method="post"
                        enctype="multipart/form-data">
<input type="file" name="file" size="50" />
<br />
<input type="submit" value="Upload File" />
</form>
</body>
</html>

<?php
$allowed= array('jpeg','jpg','pdf','ppt','pptx','doc','txt');
$file=$_FILES['file']['name'];
$target_dir = "data/";
$upload = 1;
$ext = pathinfo($file, PATHINFO_EXTENSION);
echo $ext;
switch($ext)
{
    case 'pdf':
       $target_dir = "data/pdf/";
       $target_file = $target_dir . basename($_FILES["file"]["name"]);
       if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
       }break;
    case 'jpeg':
    case 'jpg':
       $target_dir = "data/jpeg/";
       $target_file = $target_dir . basename($_FILES["file"]["name"]);
	   echo "<br>".$target_file."<br>";
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        }break;

    case 'ppt':
       $target_dir = "data/ppt/";
       $target_file = $target_dir . basename($_FILES["file"]["name"]);
       if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
       }break;
    case 'doc':
       $target_dir = "data/doc/";
       $target_file = $target_dir . basename($_FILES["file"]["name"]);
       if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
       }break;
    case 'pptx':
       $target_dir = "data/ppt/";
       $target_file = $target_dir . basename($_FILES["file"]["name"]);
       if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
       }break;
     case 'txt':
       $target_dir = "data/text/";
       $target_file = $target_dir . basename($_FILES["file"]["name"]);
       if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
       }
       break;


}

if(!in_array($ext,$allowed))
  echo "Not Supported formated";
  $upload=0;

?>