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

if (isset($_GET['submit'])){

$id = $_GET['id'];




include 'connectPDO.php';
$status='Inactive';

$sql = "delete from sales  where id=:id;";

$today = date('Y-m-d');
$result = $conn->prepare($sql);

$result ->bindParam(':id', $id);
$result ->execute();
?>

<body>
<div class="container d-flex flex-column justify-content-center">
<form class="col-lg-12 " method="post" action="adminDeleteProduct.php?id=<?php echo $id; ?>">
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Success!</h4>
</p> Your sale has been deleted! </p>

<a href="main.php"> Click here to go home </a>
</div></div>

</div>
 <?php

}

else {
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
$saleDate =  $rows['saleDate'];}





 ?>


<body>
<div class="container d-flex flex-column justify-content-center">
<form class="col-lg-12 " method="post" action="adminDeleteProduct.php?submit=true&id=<?php echo $id; ?>">
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Customer Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label><strong>Customer Name: </strong> </label>&emsp;<br>
<input   type="text" name="name" value="<?php echo $name ?>" placeholder="<?php echo $name ?> "><br>
<label ><strong>Customer Address: </strong> </label>&emsp; <br>
<input  type="text" name="address" value="<?php echo $address ?>" ><br>
<label ><strong>Customer Phone: </strong> </label>&emsp; <br>
<input type="text" name="phone" value="<?php echo $phone ?>" ><br>
<label><strong>Customer Email: </strong> </label>&emsp; <br>
<input type="text" name="email" value="<?php echo $email ?>" ><br><br>

</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Financial Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label><strong>Sale Date: </strong> </label>&emsp;<br>
<input   type="text" id="sale" name="saleDate" value="<?php echo $saleDate ?>"  onfocus="(this.type='date')">&emsp;<br><br>
<label ><strong>Amount: $ </strong> </label>&emsp;<br>
<input  type="number" step=".01" name="Amount" value="<?php echo $Amount ?>" ><br><br>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Product Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label>Product: </label><br>
<input  type="text" name ="product" value="<?php echo $product; ?>" >
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Supplemental Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body ">
<label>Notes</label><br><br>
<textarea class="form-control rounded-0" name = "text"  v rows="5"><?php echo $notes; ?></textarea>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<button type="submit" name="submit" class="btn btn-secondary">Submit</button> </div> </div> </form> 
</div>

<?php 

}  echo'</div>';
include 'footer.php';?>