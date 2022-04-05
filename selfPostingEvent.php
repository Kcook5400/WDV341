<?php

//variables from form and error messages and valid form boolean
$eventName = "";        
$eventDesc = "";
$eventPresenter = "";
$nameErrorMsg = "";
$descErrorMsg = "";
$presenterErrorMsg = "";
$validForm = "";
    
// once the form is submitted get the data 


 
if ( isset($_POST['submit'])){

    $eventName = $_POST['name'];
    $eventDesc = $_POST['description'];
    $eventPresenter = $_POST['presenter'];

// we assume the form is good to start
    $validForm = true; 


// checks validation of the form

 if($eventName == ""){
        
        $nameErrorMsg = "Event Name is required";
        $validForm = false;
    }

    if($eventDesc == ""){
        $descErrorMsg = "Event Description is required";
        $validForm = false;
    }

    if($eventPresenter == ""){
        $presenterErrorMsg = "Event Presenter is required";
        $validForm = false;
    }
  

    //if the form is good then continue server side processing
    //else display form to the users with any error messages as needed
    if( $validForm ){

 
            require 'connectPDO.php';


            $today = date("Y-m-d"); //today's date as YYYY-MM-DD

            //build the sql statement   use the INSERT statement

                $sql = "INSERT INTO wdv341_events ";
                $sql .= "(name,description, presenter, date_inserted) ";
                $sql .= "VALUES (:name, :desc, :presenter, :date_insert);";

            //prepare the statement
            $stmt = $conn->prepare($sql);

            //bind the parameters
            $stmt->bindParam(':name',$eventName);
            $stmt->bindParam(':desc',$eventDesc);
            $stmt->bindParam(':presenter',$eventPresenter);
            $stmt->bindParam(':date_insert',$today);

            //execute the statement
            $stmt->execute();
            
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
<body>
    

<div class="container d flex justify-content-center">
<div class="card text-white bg-dark mb-3"">
   	<div class="card-body">
   	<h5 class="card-title">Success</h5>
        <p class="card-text">Your event has been submitted!</p>
   	
   	</div>
   	
   	</div>
   	<div class="card">
   	<div class="card-body">
   	<a href="selfPostingEvent.php"> To submit another event click here </a>
   	</div>
   	</div>

</body>
</html>
   	
<?php


            
        } else {
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
<style>
#test_email {
    display: none;
}

.form-text { color: red;
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

<form class="col-lg justify-content-center" method="post" action="selfPostingEvent.php">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Name" value="<?php echo $eventName; ?>">
    <small id="nameError" class="form-text"><?php echo $nameErrorMsg; ?> </small>
  </div>
  <div class="form-group">
 <label for="description">Description</label>
    <input type="text" class="form-control" name="description" id="description"  placeholder="Enter Description"  value="<?php echo $eventDesc; ?>">
    <small id="descError" class="form-text"><?php echo $descErrorMsg; ?></small>
  </div>
  <div class="form-group">
 <label for="presenter">Presenter</label>
    <input type="text" class="form-control"  name="presenter" id="presenter" placeholder="Enter Presenter"  value="<?php echo $eventPresenter; ?>" >
    <small id="presentError" class="form-text"><?php echo $presenterErrorMsg; ?></small>
  </div>
    <div class="form-group">
  
  <!--HoneyPot Field -->
  
  <input id="test_email" name="email" size="25" type="text" value="" />
  
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

</div>
</div>


</div>

</body>
</html>
 
 
 <?php
}

    
} 

  

else { //show the blank form



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
<style>
#test_email {
    display: none;
}

.form-text { color: red;
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

<form class="col-lg justify-content-center" method="post" action="selfPostingEvent.php">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Name" value="<?php echo $eventName; ?>">
    <small id="nameError" class="form-text"><?php echo $nameErrorMsg; ?> </small>
  </div>
  <div class="form-group">
 <label for="description">Description</label>
    <input type="text" class="form-control" name="description" id="description"  placeholder="Enter Description"  value="<?php echo $eventDesc; ?>">
    <small id="descError" class="form-text"><?php echo $descErrorMsg; ?></small>
  </div>
  <div class="form-group">
 <label for="presenter">Presenter</label>
    <input type="text" class="form-control"  name="presenter" id="presenter" placeholder="Enter Presenter"  value="<?php echo $eventPresenter; ?>" >
    <small id="presentError" class="form-text"><?php echo $presenterErrorMsg; ?></small>
  </div>
    <div class="form-group">
  
  <!--HoneyPot Field -->
  
  <input id="test_email" name="email" size="25" type="text" value="" />
  
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

</div>
</div>


</div>

</body>
</html>
<?php

}

?>