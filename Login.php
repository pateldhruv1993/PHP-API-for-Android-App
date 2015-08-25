
<?php
$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");
if(mysqli_connect_error()){
	echo "failed to connect".mysqli_connect_error();
}


if (!empty($_POST)) {
    $username = "";
    $pwd = "";
    
    if (empty($_POST['username']) || empty($_POST['pwd'])) {
                
        $response["success"] = 0;
        $response["message"] = "Please fill all the fields.";
        
       	die(json_encode($response));
    } else{
    	$username = $_POST['username'];
    	$pwd = $_POST['pwd'];
    }
    
    $query = "SELECT username, pwd FROM users WHERE username = \"".$username."\" AND  pwd = \"".$pwd."\"";
    try {	
        $result = mysqli_query($con, $query);
    }
    catch (Exception $e) {
        $response["success"] = 0;
        $response["message"] = "Problem with connecting to the database.";
        die(json_encode($response));
    }

    if($result->num_rows == 0){
    	$response["success"] = 0;
        $response["message"] = "Wrong username or password.";
        die(json_encode($response));
    }
	else{
	    $response["success"] = 1;
	    $response["message"] = "You're logged in now.";

	    
	    //Create a session if it does not exsits
	    if(!isset($_SESSION)){session_start();}
	    $_SESSION['loggedin'] = 'true';
	    $_SESSION['username'] = strtoupper($username);

	    die(json_encode($response));
    }
}

mysqli_close($con);

?>