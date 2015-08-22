<?php
/**
 * User: Sundareswaran
 * Date: 30-07-2015
 * Time: 13:52
 */
$connect = mysqli_connect("localhost","trydevsi_tknow","tknow123","trydevsi_tknow");
if (mysqli_connect_errno()) 
{
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Variables and values
$domain = "http://techknowlogy.trydevs.in/";

// Normal IMplode without php 5.5 discrepency
function myImplode($glue,$array){
	if(count($array) > 1){
		$s = "";
		for($i = 0; $i < (count($array) - 2) ; $i++)
			$s .= $array[$i].$glue;
		$s .= $array[$i];

		return $s;
	}else{
		return $array[0];
	}
}

?>