<!DOCTYPE html>
<html>
<head>
<title> Thank you for contacting us!</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>



<?php
$date = date('m/d/Y');
$to = 'admin@max-power.info';
$subject = 'Contact Reason: '.$_POST['contactReason'];
$from = $_POST['email'];
$firstName =  $_POST['fname'];
$lastName = $_POST['lname'];
$comment = $_POST['comments'];
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
$message .= '<p> On '.$date.' <br><br> <strong>'.$firstName.', '.$lastName.' </strong> sent the following message:</p>
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
if(mail($to, $subject, $formattedMessage, $headers)){
mail($from, $UserSubject, $formattedUserMessage, $Userheaders);

?>

<div class="container d flex justify-content-center">

<div class="card text-white bg-dark mb-3">
  <div class="card-header">Success!</div>
    </div>
  <div class="card-body">
    <h5 class="card-title">Thank you <?php echo $firstName; ?>  for contacting us!</h5>
    <p class="card-text">
    Your information has been sent!</p><br>

</div>
</div>
</div>



<?php } else{ ?>
<div class="container d-flex justfy-content center">
<div class="card text-white bg-dark mb-3">
  <div class="card-header">Oops!</div>
  <div class="card-body">
    <h5 class="card-title">Thank you <?php echo $firstName; ?>  for contacting us but...<strong> something went wrong!</strong></h5>
    <p class="card-text">
    Your information has <strong> NOT </strong> been sent! Please review your info and try again</p><br>
  </div>
</div>
</div>
<?php
}
?>

</body>
</html>