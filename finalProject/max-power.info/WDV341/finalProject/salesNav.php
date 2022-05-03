<?php 

session_start(); 

if($_SESSION['validUser']!=true){

header("Location: login.php");
exit();}


echo $_SESSION['admin'];
if ($_SESSION['admin']==true){

include 'header2.html';
 
 }
 
 else {
 
include 'header.html';
} ?>



<body>

<div class="container d flex justify-content-center">

<!-- Title Card -->
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<h4 class="card-title"> <?php ?> Sales Navigation</h4>
 	</div>
 </div><br>


  
      
      <!-- Actions Card -->
<div class="card text-center bg-dark  text-white">
    <div class="card-body text-center bg-dark  text-white">

      
      
<a href="sales.php?select=enter" class="btn btn-primary btn-lg" role="button">Enter a Sale</a>&emsp; &emsp; &emsp; 

<a href="search.php?" class="btn btn-primary btn-lg" role="button">Edit/Cancel a Sale</a>&emsp; &emsp; &emsp; 



	</div>
</div>
</div>
<?php include 'footer.php'; ?>