<?php
session_start(); // start session

if($_SESSION['validUser']!=true){header("Location: login.php");exit();}

if (isset($_SESSION['admin']))	{include 'header2.html';}	else	{include 'header.html';	}

$name='';
$pass='';
$admin='';

if (isset($_POST['submit'])){

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
<form class="col-lg-12 " method="post" action="adminAddUser.php">
<label> User Name: </label> &emsp;&emsp;<br>
<label style="color:red;"> <?php echo $nameError ?> </label> <br>
<input type="text" name="name" value="<?php echo $name; ?>"><br><br>
<label> Password: </label> &emsp;&emsp; <br>
<input type="text" name ="pass" value="<?php echo $pass ?>"><br><br>
<label style="color: red;"> <?php echo $passError ?> </label> <br>
<label> Admin: </label> &emsp;&emsp; <input type="checkbox" name="admin"><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button> <br> <br><h5> Or to go back to your Admin panel <a href="admin.php"> click here </a> </h5></div> </form>



<br></div></div></div>



<?php } else {	


// insert into table
include 'connectPDO.php';
$sql = "Insert into user (name, password, admin) values (:name, :pass, :admin);";
$result = $conn->prepare($sql);
$result ->bindParam(':name', $name);
$result ->bindParam(':pass', $pass);
$result ->bindParam(':admin', $admin);
$result ->execute();
 
 ?>





<div class="container d flex justify-content-center">	 
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">You have added a user! </h4>
<a href="admin.php"class="btn btn-primary btn-lg" role="button"> To go back to your admin dashboard click here! </a><br><br>
<a href="adminViewAllUsers.php"class="btn btn-primary btn-lg" role="button"> To view all users click here! </a>
</div></div></div>

<?php	}	}	else	{	?>



<div class="container d flex justify-content-center">	
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Add a User below!</h4><br>
<form class="col-lg-12 " method="post" action="adminAddUser.php">
<label> User Name: </label> &emsp;&emsp; <input type="text" name="name" placeholder="Enter user name"><br><br>
<label> Password: </label> &emsp;&emsp; <input type="text" name ="pass" placeholder="Enter user name"><br><br>
<label> Admin: </label> &emsp;&emsp; <input type="checkbox" name="admin" placeholder="Enter yes or no"><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>  <br> <br><h5> Or to go back to your Admin panel <a href="admin.php"> click here </a> </h5></div> </form>

<?php	} echo '</div> </div>';
include 'footer.php'; ?>