<?php

if (!empty($_POST)) {
    $username = "";
    if (empty($_POST["username"])) {
        $response["success"] = 0;
        $response["message"] = "Did not receive any username.";
        die(json_encode($response));

    } else{
        $username = trim($_POST["username"]);
    }
}else{
    $response["success"] = 0;
    $response["message"] = "Did not receive any data.";
    die(json_decode($response));
}



$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");
if(mysqli_connect_error()){
  echo "failed to connect".mysqli_connect_error();
}


if($_POST("updateUserData")){
  if(empty($_POST["pwd"]) || empty($_POST["email"])){
    $response["success"] = 0;
    $response["message"] = "New password or the new email is empty.";
    die(json_decode($response));

  } else{
    $newPwd = $_POST["pwd"];
    $newEmail = $_POST["email"];

    $query = "UPDATE users SET `pwd` = '".$newPwd."', `email`='".$newEmail."' WHERE username = '".$username."'";

    if (!mysqli_query($con,$query)) {
      $response["success"] = 0;
      $response["message"] = "Problem with updating the user info. Please try again.";
      die(json_encode($response));
    }
    else{
      $response["success"] = 1;
      $response["message"] = "Userinfo updated.";
      die(json_encode($response));
    }

  }

}
else if($_POST("deleteUserData")){
  
    $query = "DELETE FROM users WHERE username = '".$username."'";

    if (!mysqli_query($con,$query)) {
      $response["success"] = 0;
      $response["message"] = "Problem with deleting user info. Please try again.";
      die(json_encode($response));
    }
    else{
      $response["success"] = 1;
      $response["message"] = "Userinfo deleted.";
      die(json_encode($response));
    }

}
else{
  //Find the users info
  $query = "SELECT * FROM users WHERE `username` = '".$username."'";


  if ($result = $con->query($query)) {
    
    $response["success"] = 1;
    $response["message"] = "User with that username available.";
    $response["userInfo"]   = array();
    
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          if($distance < $row["range"]){
              $post = array();
              $post["id"] = $row["id"];
              $post["username"] = $row["username"];
              $post["email"]    = $row["email"];

              //update our repsonse JSON data
              array_push($response["userInfo"], $post);
          }
      }


      $result->free();


      echo json_encode($response);
      
  }
}
//Disconnect from the server
mysqli_close($con);

?>