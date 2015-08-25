<?php

if (!empty($_POST)) {
    $long = "";
    $lat = "";
    $searchQuery = "";
    if (empty($_POST["search"]) ||empty($_POST["longitude"]) || empty($_POST["latitude"])) {
        $response["success"] = 0;
        $response["message"] = "Search query or Location was empty.";
        die(json_encode($response));

    } else{
        $searchQuery = trim($_POST['search']);
        $long = $_POST['longitude'];
        $lat = $_POST["latitude"];
    }
}else{
    $response["success"] = 0;
    $response["message"] = "Post data was empty.";
    die(json_decode($response));
}



$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");
if(mysqli_connect_error()){
  echo "failed to connect".mysqli_connect_error();
}




//For differnet query depending upon whether the search query was just a hashtag or a string.
if(strpos(trim($txt), '#') == 0 && strpos(trim($txt), ' ') == FALSE)
{
    //Search for hashtag
    $query = "SELECT `id`, `post`, `user`, `long`, `lat`, `range`, `timestamp` FROM posts WHERE UPPER(`post`) LIKE '%$searchQuery%' ORDER BY id DESC";
}
else
{
    //Search for a string
    $query = "SELECT `id`, `post`, `user`, `long`, `lat`, `range`, `timestamp` FROM posts WHERE MATCH (post) AGAINST ('%$searchQuery%'  IN NATURAL LANGUAGE MODE) ORDER BY id DESC";
}


if ($result = $con->query($query)) {
  
  $response["success"] = 1;
  $response["message"] = "Posts available";
  $response["posts"]   = array();
  
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        $distance = vincentyGreatCircleDistance($long, $lat, $row["long"], $row["lat"]);
        if($distance < $row["range"]){
            $post = array();
            $post["id"] = $row["id"];
            $post["username"] = $row["user"];
            $post["post"]    = $row["post"];
            $post["longitude"]  = $row["long"];
            $post["latitude"] = $row["lat"];
            $post["timestamp"]  = $row["timestamp"];
            $post["distance"]  = $distance;
            
            //update our repsonse JSON data
            array_push($response["posts"], $post);
        }
    }


    $result->free();



    //Check if user wants to sort by distance or timestamp
    if(!empty($_POST["sortByDistance"]) && $_POST["sortByDistance"]){
      usort($response["posts"], function($a, $b) {
        return $a["distance"] - $b["distance"];
      });
    }

    //Loop through all the posts and convert meters into kilometers if its more than 1000 meters
    foreach($response["posts"] as &$dis){
        if($dis["distance"] >= 1000){
          $dis["distance"] = $dis["distance"]/1000;
          $dis["distance"] = number_format($dis["distance"], 2, '.', ',')." Km";
        }else{
          $dis["distance"] = number_format($dis["distance"])." m";
        }
    }

    
    // echoing JSON response
    echo json_encode($response);
    
}

//Disconnect from the server
mysqli_close($con);








/**
 * Calculates the great-circle distance between two points, with
 * the Vincenty formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}


?>