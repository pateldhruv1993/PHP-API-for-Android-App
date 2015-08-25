<?php

if (empty($_POST["postID"])) {
    $response["success"] = 0;
    $response["message"] = "Did not receive any username.";
    die(json_encode($response));

} else{

    $postID = trim($_POST["postID"]);

}



$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");
if(mysqli_connect_error()){
  echo "failed to connect".mysqli_connect_error();
}

$query = "UPDATE posts SET `reports` = `reports` + 1  WHERE id = ". $postID;

if (!mysqli_query($con,$query)) {
      $response["success"] = 0;
      $response["message"] = "Problem occured while reporting that post. Please try again later.";
      die(json_encode($response));
    }
    else{
      $response["success"] = 1;
      $response["message"] = "Post reported.";
      die(json_encode($response));
}

//Disconnect from the server
mysqli_close($con);

?>