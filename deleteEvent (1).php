<?php
session_start();       

if( isset($_SESSION['validUser'])){
    $validUser = true;    

    $userName = $_SESSION['userName'];
}
else{
    //deny access, return to login page/home page
    header("Location: login.php");           
}


    $eventId = $_GET['eventId'];

try{
    include 'connectPDO.php';

    $sql = "DELETE FROM wdv341_events WHERE id = :eventId;";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':eventId', $eventId);

    $stmt->execute();

    $count = $stmt->rowCount();

}
catch(PDOException $e)
{
    $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
    error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log

			
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Events Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container d flex justify-content-center">
<div class="card text-white bg-dark mb-3"">
   	<div class="card-body">
   	<h5 class="card-title">Delete Event</h5>
   	   	<h5 class="card-title"><a href="login.php"> Home </a></h5>
</div>
</div>
<div class="card text-white mb-3"">
   	<div class="card-body">

    <?php
        if($count > 0){
            echo "<h3>$count row has been deleted for event_id $eventId</h3><br>
            
            <a href=\"selectEvents.php\"> To go back to your your events table click here </a>
            ";
            
            
            
        }
        else{
            echo "<h3>No rows deleted for selected event_id $eventId</h3><br>
            
            
            <a href=\"selectEvents.php\"> To go back to your your events table click here </a>";
        }
    ?>
</div>
</div>
</div>

</body>
</html>