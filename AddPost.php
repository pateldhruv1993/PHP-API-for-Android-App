 <?php


$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");
if(mysqli_connect_error()){
	echo "failed to connect".mysqli_connect_error();
}



if (!empty($_POST)) {
	$post = "";
	$long = "";
	$lat = "";
	if (empty($_POST['post']) || empty($_POST['longitude']) || empty($_POST['latitude']) || empty($_POST['range'])) {

		$response["success"] = 0;
		$response["message"] = "Post, location or range was empty.";
		
		die(json_encode($response));
	} else{
		$post = $_POST['post'];
		$user = $_POST['user'];
		$long = $_POST['longitude'];
		$lat = $_POST['latitude'];	
		$range = $_POST['range'];
		//$timestamp = $_POST['timestamp'];
	}

	$query="INSERT INTO posts (`post`, `user`, `long`, `lat`, `range`, `timestamp`) VALUES (\"".$post."\", \"".$user."\", \"".$long."\", \"".$lat."\", \"".$range."\", now())";

	//$query="INSERT INTO posts (post, user, long, lat, range, timestamp) VALUES (\"".$post."\", \"".$user."\", \"".$long."\", \"".$lat."\", \"".$range."\", \"".$timestamp."\")";

	if (!mysqli_query($con,$query)) {
		$response["success"] = 0;
		$response["message"] = "Problem with adding your post. Please try again." ;
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