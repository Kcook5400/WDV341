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
}




?>

<div class="container d flex justify-content-center">

<!-- Title Card -->
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<h4 class="card-title"> Seafoam Customer Search</h4>

<form class="col-lg justify-content-center" method="post" action="searchResults.php">
  <div class="form-group">
    <label for="search">Enter the Customer Name to search for them</label>
    <input type="text" class="form-control" name ="search" id="search" placeholder="Enter customer name/account number here">
  </div>
<br>
 <a href="searchResults.php?search=all">Or to see a list of all customers click here</a><br><br><br>


 <button type="submit" class="btn btn-primary">Submit</button>
</div>
<br>


<br>

</form>

 	</div>
 </div><br>

</div>
</div>
</div>
<?php include 'footer.php';?>