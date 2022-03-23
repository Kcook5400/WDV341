<?php

include 'connectPDO.php';

$name = $_POST['name'];
$description = $_POST['description'];
$presenter = $_POST['presenter'];
$date = $_POST['date'];
$time = date('h:m:s', strtotime($_POST['time']));
$dateInserted = date('Y-m-d');
$dateUpdated = date('Y-m-d');

$sql = "INSERT INTO wdv341_events (name, description, presenter, date, time, date_inserted, date_updated) VALUES (:name, :description, :presenter, :dateSub, :timeSub, :dateInsert, :dateUpdate);";
$result = $conn->prepare($sql);
$result->bindParam(':name',$name);
$result->bindParam(':description',$description);
$result->bindParam(':presenter',$presenter);
$result->bindParam(':dateSub',$date);
$result->bindParam(':timeSub', $time);
$result->bindParam(':dateInsert',$dateInserted);
$result->bindParam(':dateUpdate',$dateUpdated);

$result->execute();


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
</head>
<div class="container d flex justify-content-center">
<div class="card text-white bg-dark mb-3"">
   	<div class="card-body">
   	<h5 class="card-title">Success!</h5>
   <p> Your entry has been submitted! <p>
   	
   	</div>
   	
   	</div>
</div>