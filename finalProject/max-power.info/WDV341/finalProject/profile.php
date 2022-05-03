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


$id = $_GET['id'];

include 'connectPDO.php';
$sql = "select * from sales where id=:id;";
$result = $conn->prepare($sql);
$result ->bindParam(':id', $id);
$result ->execute();

while($rows = $result->fetch()){

$name = $rows['name'];
$email = $rows['email'];
$address = $rows['address'];
$phone = $rows['phone'];
$Amount = $rows['amount'];
$product = $rows['product'];
$notes = $rows['notes'];
$saleDate =  $rows['saleDate'];
$status= $rows['status'];
}
 ?>


<body>
<div class="container d-flex flex-column justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<h4 class="card-title"> <?echo $name; ?> Customer Profile</h4> <br>		
   		
<label><strong>Status: </strong> <?php echo $status; ?></label>&emsp; <br><br><br>

<label><strong>Customer Name: </strong><?php echo $name ?> </label>&emsp;<br>

<label ><strong>Customer Address: </strong><?php echo $address ?> </label>&emsp; <br>

<label ><strong>Customer Phone: </strong> <?php echo $phone ?></label>&emsp; <br>

<label><strong>Customer Email: </strong> <?php echo $email ?></label>&emsp; <br>



<h4 class="card-title">Financial Information</h4>

<label><strong>Sale Date: </strong>   <?php echo $saleDate ?></label>&emsp;<br>
<label ><strong>Amount:  </strong>$ <?php echo $Amount ?> </label>&emsp;<br>


<h4 class="card-title">Product Information</h4>

<label><strong>Product:</strong> <?php echo $product ?> </label><br>



<h4 class="card-title">Supplemental Information</h4>

<label><strong>Notes: </strong>  <?php echo $notes; ?></label><br><br>

 </div> </div> 

<a href="sales.php?select=edit&id=<?php echo $id ?>" class="btn btn-primary btn-lg" role="button">Edit this customer's information</a>&emsp; &emsp; &emsp; 


<a href="sales.php?select=cancel&id=<?php echo $id ?>" class="btn btn-primary btn-lg" role="button">Cancel this customer</a>&emsp; &emsp; &emsp; 















</div>

<?php include 'footer.php'; ?>