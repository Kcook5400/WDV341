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


//if statement to determine if this is entering or editing or cancelling a sale



if($_GET['select']=="enter"){

// Set variables
$name = '';
$address = '';
$phone = '';
$email = '';
$saleDate='';
$billDate='';
$Amount='';
$product='';
$nameError='';
$addressError='';
$phoneError='';
$emailError='';
$saleDateError='';
$productError='';
$AmountError='';
$notes='';


if (isset($_POST['submit']))  {

// After form has been submitted gather field variables from the post array
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$saleDate = $_POST['saleDate'];
$Amount = $_POST['Amount'];
$product = $_POST['product'];

if(isset($_POST['text'])){
$notes = $_POST['text'];}

$validForm=true;



// Check if they are blank, if they are show the same form with errors

if($name==''){
$nameError= "Please enter a customer name"; $validForm = false;}

if($address==''){
$addressError= "Please enter an address"; $validForm = false;}

if ($phone==''){
$phoneError= "Please enter a phone number"; $validForm = false;}

if($email==''){
$emailError= "Please enter an email address"; $validForm = false;}

if($saleDate==''){
$saleDateError= "Please enter a sale date"; $validForm = false;}

if($Amount==''){
$AmountError= "Please enter an amount"; $validForm = false;}

if($product==''){
$productError= "Please enter a product"; $validForm = false;}



if (!$validForm) {

?>



<body>
<div class="container d-flex flex-column justify-content-center">
<form class="col-lg-12 " method="post" action="sales.php?select=enter">
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Customer Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label><strong>Customer Name: </strong> </label>&emsp;<br>
<label style="color:red"> <?php echo $nameError; ?> </label><br>
<input   type="text" name="name" value="<?php echo $name ?>" placeholder="<?php echo $name ?> "><br>
<label ><strong>Customer Address: </strong> </label>&emsp; <br>
<label style="color:red"> <?php echo $addressError; ?> </label><br>
<input  type="text" name="address" value="<?php echo $address ?>" ><br>
<label ><strong>Customer Phone: </strong> </label>&emsp; <br>
<label style="color:red"> <?php echo $phoneError; ?> </label><br>
<input type="text" name="phone" value="<?php echo $phone ?>" ><br>
<label><strong>Customer Email: </strong> </label>&emsp; <br>
<label style="color:red"> <?php echo $emailError; ?> </label><br>
<input type="text" name="email" value="<?php echo $email ?>" ><br><br>

</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Financial Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label><strong>Sale Date: </strong> </label>&emsp;<br>
<label style="color:red"> <?php echo $saleDateError; ?> </label><br>
<input   type="date" id="sale" name="saleDate">&emsp;<br><br>
<label ><strong>Amount: $ </strong> </label>&emsp;<br>
<label style="color:red"> <?php echo $AmountError; ?> </label><br>
<input  type="number" step=".01" name="Amount" value="<?php echo $Amount ?>" ><br><br>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Product Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label>Product: </label><br>
<label style="color:red"> <?php echo $productError; ?> </label><br>
<input  type="text" value="<?php echo $product ?>" name ="product">

</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Supplemental Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body ">
<label>Notes</label><br><br>
<textarea class="form-control rounded-0" name = "text" rows="5"></textarea>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<button type="submit" name="submit" class="btn btn-secondary">Submit</button> </div> </div> </form>
</div>
<?php }

else{

// insert into table
$today = date('Y-m-d');
$status='Active';
include 'connectPDO.php';
$sql = "Insert into sales (name, address, phone, email, saleDate, amount, product, notes, dateInserted, status) values (:name, :address, :phone, :email, :saleDate, :amount, :product, :notes, :today, :status);";
$result = $conn->prepare($sql);
$result ->bindParam(':name', $name);
$result ->bindParam(':address', $address);
$result ->bindParam(':phone', $phone);
$result ->bindParam(':email', $email);
$result ->bindParam(':saleDate', $saleDate);
$result ->bindParam(':amount', $Amount);
$result ->bindParam(':product', $product);
$result ->bindParam(':notes', $notes);
$result ->bindParam(':today', $today);
$result ->bindParam(':status', $status);
$result ->execute();
 ?>


<body>
<div class="container d-flex flex-column justify-content-center">
<form class="col-lg-12 " method="post" action="sales.php">
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Success!</h4>
</p> Your sale has been entered! </p>

<a href="main.php"> Click here to go home </a>
</div></div>

</body>
</html>

<?php

}





 }
else { ?>

<body>
<div class="container d-flex flex-column justify-content-center">
<form class="col-lg-12 " method="post" action="sales.php?select=enter">
<div class="card text-white bg-dark mb-3 text-center">
<div class="card-body text-center">
<h4 class="card-title">Customer Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label><strong>Customer Name: </strong> </label>&emsp; <br>
<input   type="text" name="name" value="" placeholder="Customer name"><br>
<label><strong>Customer Address: </strong> </label><br>
<input  type="text" name="address" value="" placeholder="Address"><br>
<label ><strong>Customer Phone: </strong> </label>&emsp; <br>
<input type="text" name="phone" value="" placeholder="Phone" ><br>
<label for="name"><strong>Customer Email: </strong> </label>&emsp; <br>
<input type="text" name="email" value="" placeholder="Email" ><br><br>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Financial Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label><strong>Sale Date: </strong> </label>&emsp;<br>
<label id = "saleError" style="color:red;"></label><br> 
<input   type="date" id="sale" name="saleDate" >&emsp;<br><br>
<label><strong>Amount: $ </strong> </label>&emsp;<br>
<input  type="text" name="Amount" value="" placeholder="Amount" ><br><br>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Product Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<label>Product: </label><br>
<input  type="text" value="" name ="product" placeholder="Product">
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Supplemental Information</h4>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body ">
<label>Notes</label><br><br>
<textarea class="form-control rounded-0" name = "text" rows="5"></textarea>
</div></div>
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<button type="submit" name="submit" class="btn btn-secondary">Submit</button> </div> </div> </form>
<?php }

}

elseif ($_GET['select']=="edit") {


if (isset($_GET['submit'])){

$id = $_GET['id'];

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$saleDate = $_POST['saleDate'];
$Amount = $_POST['Amount'];
$product = $_POST['product'];
if(isset($_POST['text'])){
$notes = $_POST['text'];}

$today = date('Y-m-d');
include 'connectPDO.php';
$sql = "update sales set name=:name, address=:address, phone=:phone, email=:email, saleDate=:saleDate, amount=:amount, product=:product, notes=:notes, dateInserted=:today where id=:id;";


$result = $conn->prepare($sql);
$result ->bindParam(':name', $name);
$result ->bindParam(':address', $address);
$result ->bindParam(':phone', $phone);
$result ->bindParam(':email', $email);
$result ->bindParam(':saleDate', $saleDate);
$result ->bindParam(':amount', $Amount);
$result ->bindParam(':product', $product);
$result ->bindParam(':notes', $notes);
$result ->bindParam(':today', $today);
$result ->bindParam(':id', $id);
$result ->execute();
?>

<body>
<div class="container d-flex flex-column justify-content-center">
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Success!</h4>
</p> Your sale has been edited! </p>

<a href="main.php"> Click here to go home </a>
</div></div>

</body>
</html>
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
<form class="col-lg-12 " method="post" action="sales.php?select=edit&submit=true&id=<?php echo $id; ?>">
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

<?php }

}

else {

if (isset($_GET['submit'])){

$id = $_GET['id'];




include 'connectPDO.php';
$status='Inactive';

$sql = "update sales set status=:status, cancelDate=:today where id=:id;";

$today = date('Y-m-d');
$result = $conn->prepare($sql);
$result ->bindParam(':status', $status);
$result ->bindParam(':today', $today);
$result ->bindParam(':id', $id);
$result ->execute();
?>

<body>
<div class="container d-flex flex-column justify-content-center">
<form class="col-lg-12 " method="post" action="sales.php?select=cancel&submit=true&id=<?php echo $id; ?>">
<div class="card text-white bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Success!</h4>
</p> Your sale has been cancelled! </p>

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
<form class="col-lg-12 " method="post" action="sales.php?select=cancel&submit=true&id=<?php echo $id; ?>">
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

<h1> HERE </h1>
<?php 

} } echo'</div>';
include 'footer.php';?>