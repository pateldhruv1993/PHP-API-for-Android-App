<?php
echo"<META HTTP-EQUIV=\"Refresh\" CONTENT=\"60\"><html><head><title>Delete old records</title></head><body>";

$con = mysqli_connect("localhost", "root", "WhatHappendPWD.", "whathappend");

if(mysqli_connect_error()){
  echo "failed to connect".mysqli_connect_error();
}




$query = "DELETE FROM `posts` WHERE `timestamp` < (NOW() - INTERVAL 1 MINUTE)";

if (!mysqli_query($con,$query)) {
      
  echo "problem deleting posts";
}
else{
  echo "Number of rows deleted: ". $con->affected_rows;
  echo "<br><div id='timer_div'></div>";
}


//Disconnect from the server
mysqli_close($con);
?>
<script>
var seconds_left = 60;
var interval = setInterval(function() {
    --seconds_left;
    document.getElementById('timer_div').innerHTML = "Refresh in: " + seconds_left;

    if (seconds_left <= 0)
    {
        document.getElementById('timer_div').innerHTML = 'Any secon now...';
        clearInterval(interval);
    }
}, 1000);
</script>

</body>
</html>


