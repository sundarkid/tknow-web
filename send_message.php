
<?php

require "databaseAndFunctions.php";

date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['message']) && isset($_POST['title']) && isset($_POST['name'])){
	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$file_name = $image;
		$ext = pathinfo($image, PATHINFO_EXTENSION);
		$allowed = array('jpeg','jpg','png');
		if(in_array($ext,$allowed)){
			$file_name_md5 = md5($file_name.date("Y-m-d , h:i:s"));
			$target_file = "image/".$file_name_md5.".".$ext;
			move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
			$file_name = $domain.$target_file;
			work($file_name, $connect);
		}else{
			echo "File type not allowed";
		}
	}
	else
		work("",$connect);
	
}else{
	echo "Some Details are missing";
}

// Doing all the work
function work($file_name,$connect){
	$title = $_POST['title'];
	$name = $_POST['name'];
	$description = $_POST['message'];
	$url = "";
	if(isset($_POST['url']))
		$url = $_POST['url'];
	$time = date("Y-m-d , H:i:s");
	$query = "INSERT INTO `posts`(`title`, `description`, `name`, `image`, `url`, `time`) VALUES ('$title', '$description', '$name', '$file_name', '$url', '$time')";
	echo $query;
	$result = mysqli_query($connect, $query);
	var_dump($result);
	if($result){
		$pid = mysqli_insert_id($connect);
		$selectQuery = "SELECT * FROM `posts` WHERE `pid` = '$pid'";
		$selectResult = mysqli_query($connect, $selectQuery);
		if($selectResult){
			if($row = mysqli_fetch_array($selectResult)){
				$message[] = array("message" => $description, "name" => $name, "title" => $title, "image" => $file_name, "date" => $row['time'], "url" => $url);
				$messages = array('post' => $message);
				// TODO uncomment send_push_notification() to send message to devices
				//var_dump($messages);
				//echo "<br>".json_encode($messages);
				send_push_notification($reg_ids,json_encode($messages));
			}
		}
	}else{
		echo "<br>Error";
	}
}

//Sending Push Notification
   function send_push_notification($registatoin_ids, $message) {
         
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
	
		$DATA = array("message" => $message);
		
        $fields = array(
            'to' => "/topics/tknow",
            'data' => $DATA,
        );
        $headers = array(
            'Authorization: key=' . 'AIzaSyAsdZqCOb9mXQPNPuwqOB3NObUGVZA8yPE',
            'Content-Type: application/json'
        );
        //print_r($headers);
		//echo stripcslashes(json_encode($fields));
		//var_dump($fields); 
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        echo $result;
    }
	
?>