<?php
/**
 * User: Sundareswaran
 * Date: 30-07-2015
 * Time: 10:24 AM
 */
require 'databaseAndFunctions.php';
if(isset($_POST['token'])) {
    if (isset($_POST['user_id']))
        $user_id = $_POST['user_id'];
    else
        $user_id = 0;
    $token = $_POST['token'];
    $query = "INSERT INTO `gcm_tokens`(`token`) VALUES ('$token');";
    $result  = mysqli_query($connect,$query);
    if($result){
        echo json_encode(array('result' => "success"));
    }
    else
        echo json_encode(array('result' => "failure"));
}
else
    echo json_encode(array('result' => "failure"));

?>