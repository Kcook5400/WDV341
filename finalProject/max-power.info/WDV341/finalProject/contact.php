<?php
session_start(); // start session

if($_SESSION['validUser']!=true){header("Location: login.php");exit();}

if (isset($_SESSION['admin']))	{include 'header2.html';}	else	{include 'header.html';	}


?>




<?php

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
        
        $nameErrorMsg = "Name is required";
        $validForm = false;
    }

    if($eventDesc == ""){
        $descErrorMsg = "Description is required";
        $validForm = false;
    }

    if($eventPresenter == ""){
        $presenterErrorMsg = "Email is required";
        $validForm = false;
    }
  

    //if the form is good then continue server side processing
    //else display form to the users with any error messages as needed
    if( $validForm ){
    
    $date = date('m/d/Y');
$to = 'admin@max-power.info';
$subject = 'Website Issue';
$from = $_POST['presenter'];
$comment = $_POST['description'];
$UserSubject = 'Contact Submission';


// Create email headers for me and user
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:'.$from. "\r\n";

$Userheaders  = 'MIME-Version: 1.0' . "\r\n";
$Userheaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$Userheaders .= 'From:'.$to. "\r\n";


// Compose a message to be emailed to me
$message = '<html><body><br>
  <div class="card-body">';
$message .= '<p> On '.$date.' <br><br> <strong>'.$from.' </strong> sent the following message:</p>
<br><p><em> '.$comment.'</em></p><br>
<p> Please add them to your task list </p>
</body></html>';
// Compose a message to be emailed to the user
$Usermessage = '<html><body><br>
  <div class="card-body">';
$Usermessage .= '<p> On '.$date.' <br><br> We recieved the following message:</p>
<br><p><em> '.$comment.'</em></p><br><p> <strong>Your message has been sent to our team and someone will be in contact shortly!</strong></p><br>';


$formattedMessage = wordwrap($message,60,"\n");
$formattedUserMessage = wordwrap($Usermessage,60,"\n");
// Sending email
mail($to, $subject, $formattedMessage, $headers);
mail($from, $UserSubject, $formattedUserMessage, $Userheaders);


 
       
            
            ?>
            

    

<div class="container d flex justify-content-center">
<div class="card text-white bg-dark mb-3 text-center">
   	<div class="card-body">
   	<h5 class="card-title">Success</h5>
        <p class="card-text">Your issue has been sent to our team! Someone will  be in contact shortly!</p>
   	
   	</div>
   	
   	</div>

</div>
   	
<?php


            
        } else {
 ?> 
 

<style>
#test_email {
    display: none;
}

.form-text { color: red;
}

</style>


<div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title">  Need help? Fill out the form below!</h4> 



<form class="col-lg justify-content-center" method="post" action="contact.php">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Name" value="<?php echo $eventName; ?>">
    <small id="nameError" class="form-text"><?php echo $nameErrorMsg; ?> </small>
  </div>
  <div class="form-group">
 <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description"  placeholder="Enter Description of issue" ><?php echo $eventDesc; ?></textarea>
    <small id="descError" class="form-text"><?php echo $descErrorMsg; ?></small>
  </div>
  <div class="form-group">
 <label for="presenter">Presenter</label>
    <input type="text" class="form-control"  name="presenter" id="presenter" placeholder="Enter Email"  value="<?php echo $eventPresenter; ?>" >
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

 
 
 <?php
}

    
} 

  

else { //show the blank form



?>


<style>
#test_email {
    display: none;
}

.form-text { color: red;
}

</style>

<div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title">  Need help? Fill out the form below!</h4> 


<form class="col-lg justify-content-center" method="post" action="contact.php">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Name" value="<?php echo $eventName; ?>">
    <small id="nameError" class="form-text"><?php echo $nameErrorMsg; ?> </small>
  </div>
  <div class="form-group">
 <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description"  placeholder="Enter Description of issue" ><?php echo $eventDesc; ?></textarea>
    <small id="descError" class="form-text"><?php echo $descErrorMsg; ?></small>
  </div>
  <div class="form-group">
 <label for="presenter">Email Address</label>
    <input type="text" class="form-control"  name="presenter" id="presenter" placeholder="Enter email"  value="<?php echo $eventPresenter; ?>" >
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



</div></div></div>


<?php include 'footer.php'; ?>