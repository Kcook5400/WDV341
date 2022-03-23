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
<style>
#test_email {
    display: none;
}
</style>
</head>
<body>
<div class="container d flex justify-content-center">
<div class="card text-white bg-dark mb-3"">
   	<div class="card-body">
   	<h5 class="card-title">Events Form</h5>
    <p class="card-text">Enter your info below to submit an event!</p>
   	
   	</div>
   	
   	</div>

<div class="card">
   	<div class="card-body">

<form class="col-lg justify-content-center" method="post" action="eventsFormSubmission.php">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Name">
  </div>
  <div class="form-group">
 <label for="description">Description</label>
    <input type="text" class="form-control" name="description" id="description"  placeholder="Enter Description">
  </div>
  <div class="form-group">
 <label for="presenter">Presenter</label>
    <input type="text" class="form-control"  name="presenter" id="presenter" placeholder="Presenter">
  </div>
    <div class="form-group">
 <label for="date">Date</label>
    <input type="date" class="form-control"  name="date" id="date" placeholder="Enter Date">
  </div>
    <div class="form-group">
 <label for="name">Time</label>
    <input type="time" class="form-control"  name="time" id="time"  placeholder="Enter Time">
  </div>
  
  <!--HoneyPot Field -->
  
  <input id="test_email" name="email" size="25" type="text" value="" />
  
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
</div>


</div>

</body>