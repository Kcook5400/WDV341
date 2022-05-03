<?php
session_start(); // start session

if($_SESSION['validUser']!=true){header("Location: login.php");exit();}

if (isset($_SESSION['admin']))	{include 'header2.html';}	else	{include 'header.html';	}

$name='';
$pass='';
$admin='';

if (isset($_GET['id'])){
$id=$_GET['id'];
include 'connectPDO.php';
$sql = "Select * from user where id =:id;";
$stmt = $conn->prepare($sql);
$stmt ->bindParam(':id', $id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while($row=$stmt->fetch()){ 

$name=$row['name'];
$pass=$row['password'];
$admin=$row['admin'];}
$checked='';
if ($admin==true){$checked='checked';}
 ?>

<div class="container d flex justify-content-center">	
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Add a User Below</h4><br>
<form class="col-lg-12 " method="post" action="adminEditUser.php">
<label> User Name: </label> &emsp;&emsp;<br>
<input type="text" name="name" value="<?php echo $name; ?>"><br><br>
<label> Password: </label> &emsp;&emsp; <br>
<input type="text" name ="pass" value="<?php echo $pass ?>"><br><br>
<label> Admin: </label> &emsp;&emsp; <input type="checkbox" name="admin" <?php echo $checked; ?>><br><br>
<input type="text" name="id" value ="<?php echo $id; ?>" hidden>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>  </div> </form></div></div></div>
<?php }

elseif (isset($_POST['submit'])){
$id= $_POST['id'];
$name=$_POST['name'];
$pass=$_POST['pass'];
$admin=isset($_POST['admin']);
$nameError='';
$passError='';
$validForm=true;

if ($name == ''){$nameError = 'User name cannot be blank'; $validForm=false;}

if ($pass == ''){ $passError = 'Password cannot be blank'; $validForm=false;}

if(!$validForm){	?>
<div class="container d flex justify-content-center">	
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Add a User Below</h4><br>
<form class="col-lg-12 " method="post" action="adminEditUser.php">
<label> User Name: </label> &emsp;&emsp;<br>
<label style="color:red;"> <?php echo $nameError ?> </label> <br>
<input type="text" name="name" value="<?php echo $name; ?>"><br><br>
<label> Password: </label> &emsp;&emsp; <br>
<input type="text" name ="pass" value="<?php echo $pass ?>"><br><br>
<label style="color: red;"> <?php echo $passError ?> </label> <br>
<label> Admin: </label> &emsp;&emsp; <input type="checkbox" name="admin"><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>  </div> </form></div></div></div>

<?php } else {
include 'connectPDO.php';
$sql = "Update user set name=:name, password=:pass, admin=:admin where id=:id;";
$result = $conn->prepare($sql);
$result ->bindParam(':name', $name);
$result ->bindParam(':pass', $pass);
$result ->bindParam(':admin', $admin);
$result ->bindParam(':id', $id);
$result ->execute();?>

<div class="container d flex justify-content-center">	 
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">You have edited a user! </h4>
<a href="admin.php"class="btn btn-primary btn-lg" role="button"> To go back to your admin dashboard click here! </a><br><br>
<a href="adminViewAllUsers.php"class="btn btn-primary btn-lg" role="button"> To view all users click here! </a>
</div></div></div>

<?php	}	}	else	{	?>



<div class="container d flex justify-content-center">	
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Select a user to edit below!</h4><br>		
<table class="table table-hover text-white">
<tbody>
<?php 
include 'connectPDO.php';
$sql = "Select * from user;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);	?>
<th scope="col" > Customer </th>
<?php	while($row=$stmt->fetch()){ 
echo '<tr>';
echo '<td><a href="adminEditUser.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
echo '</tr>';
	}	?>
</table>
<h5> Or to go back to your Admin panel <a href="admin.php"> click here </a> </h5><br>
</div>
</div>
</div> 
<?php	} include 'footer.php';?>