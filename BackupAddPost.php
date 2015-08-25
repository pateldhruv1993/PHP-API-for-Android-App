<?php



$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");
if(mysqli_connect_error()){
	echo "failed to connect".mysqli_connect_error();
}



if (!empty($_POST)) {
	$post = "";
	$location = "";
	if (empty($_POST['post']) || empty($_POST['location'])) {

		$response["success"] = 0;
		$response["message"] = "Post or timestamp was empty.";
		
		die(json_encode($response));
	} else{
		$post = $_POST['post'];
		$location = $_POST['location'];
		$user = $_POST['user'];

	}

	$query="INSERT INTO posts (post, user, location, timestamp) VALUES (\"".$post."\", \"".$user."\", \"".$location."\", now())";

	if (!mysqli_query($con,$query)) {
		$response["success"] = 0;
		$response["message"] = "Problem with adding your post. Please try again.";
		die(json_encode($response));
	}
	else{
		$response["success"] = 1;
		$response["message"] = "Everything looks fine.";
		die(json_encode($response));
	}
}



//Disconnect from the server
mysqli_close($con);
?>