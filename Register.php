
<?php
$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");
if(mysqli_connect_error()){
	echo "failed to connect".mysqli_connect_error();
}


if (!empty($_POST)) {
    $username = "";
    $pwd = "";
    $confirmPwd = "";
    $email = "";
    if (empty($_POST['username']) || empty($_POST['pwd'])  || empty($_POST['confirmPwd'])  || empty($_POST['email'])) {
                
        $response["success"] = 0;
        $response["message"] = "Please fill all the fields.";
        
       	die(json_encode($response));
    } else{
    	$username = $_POST['username'];
    	$pwd = $_POST['pwd'];
    	$confirmPwd = $_POST['confirmPwd'];
    	$email = $_POST['email'];
    }
    
    $query = "SELECT 1 FROM users WHERE username = \"".$username."\"";
    try {	
        $result = mysqli_query($con, $query);
    }
    catch (Exception $e) {
        $response["success"] = 0;
        $response["message"] = "Problem with first mysql query.";
        die(json_encode($response));
    }

    if($result->num_rows != 0){
    	$response["success"] = 0;
        $response["message"] = "Username taken.";
        die(json_encode($response));
    }

    if($pwd != $confirmPwd){
		$response["success"] = 0;
        $response["message"] = "Your passwords do not match.";
        die(json_encode($response));
    }

    $query="INSERT INTO users (username, pwd, email) VALUES (\"".$username."\", \"".$pwd."\", \"".$email."\")";

	if (!mysqli_query($con,$query)) {
		$response["success"] = 0;
	    $response["message"] = "Problem with inserting your information. Please try again.";
		die(json_encode($response));
	}
	else{
	    $response["success"] = 1;
	    $response["message"] = "Everything looks fine.";

	    die(json_encode($response));
    }
}

mysqli_close($con);

?>