<?php

session_start(); // start a session



// first check ifthe insert variable is set

if (isset($_GET['insert'])){
	include 'connectPDO.php';
	$userName = $_POST['name'];
	$passWord = $_POST['pass'];
	
	// check if info already exists first
	$sql = "select * from user where name =:user and password = :pass";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
    	
    	$stmt->execute();
    	$result = $stmt->fetch();
    	
    	if ($result)
    	{ ?> 

<?php include 'header3.html'; ?>
 <div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title bg-warning"> Error! These credentials already exist!</h4>
<h4 class="card-title"> Please try a different username or password below</h4>
</div>
</div><br
<!-- Form Card -->
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<form method="post" action="login.php?insert=insert">
<div class="form-group">
<h1> </h1>
<label for="username">User Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Username"></div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password"></div><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>
</form> </div></div><br>
</body>
</html>
<?php } else{

	// insert user info into the table
	include 'connectPDO.php';
	
	$sql = "Insert into user (name, password) values(:user, :pass)";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
    	$stmt->execute(); 

?> 

<?php include 'header3.html'; ?>

 <div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title bg-success"> Success! Your user information has been saved!</h4>
<h4 class="card-title"> Please login below</h4>
</div>
</div><br
<!-- Form Card -->
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<form method="post" action="login.php">
<div class="form-group">
<h1> </h1>
<label for="username">User Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Username"></div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password"></div><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>
</form> </div></div><br>
</body>
</html>
<?php } }

//  we check if the user selected the create user link and let them create their credentials here


elseif (isset($_GET['create'])){ ?> 

<?php include 'header3.html'; ?>
<body>
<!-- Create User Form -->
<div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title"> Create your Username and Password Below</h4></div></div><br>

<!-- Form Card -->
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<form method="post" action="login.php?insert=insert">
<div class="form-group">
<h1> </h1>
<label for="username">User Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Username"></div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password"></div><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>
</form> </div></div><br></div>
</body>
</form>
<?php


 } 

// else if the user hasn't selected to create credentials, or insert them into the DB we need to check if the form has been submitted
 

elseif(isset($_POST['submit'])){

// if the form has been submitted check first that the username and password fields aren't blank

if ($_POST['name']!= '' & $_POST['pass']!= ''){
	
	
	// if they are NOT blank, check if the credentials exist
	
 	$userName = $_POST['name'];
        $passWord = $_POST['pass'];
 	
 	include 'connectPDO.php'; 
    	$sql = "SELECT count(*) from user WHERE name = :user AND password = :pass";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
    	$stmt->execute(); 
        $rowCount = $stmt->fetchColumn();   
        
        // check if the user exists in the DB
        
       if($rowCount > 0){
     
        
        $validUser = true;
        $_SESSION['validUser'] = true; 
        $_SESSION['userName'] = $userName; 
           
        $sql = "SELECT * from user WHERE name = :user AND password = :pass";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
    	$stmt->execute(); 
        

        while($rows=$stmt->fetch()){ 

        if ($rows['admin']==true){
            $_SESSION['admin']=true; }           
        
         else {$_SESSION['admin']=false;}
           }
       header("Location: main.php");

        
        }
        
        
        
       
        
        else {
        
        // show form with error message for invalid login
        
            $msg = "Invalid username or password, please try again!"; ?>
            
<?php include 'header3.html'; ?>
<body>

<div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title"> Login Below</h4>
<h4 class="card-title bg-danger"> <?php echo $msg; ?></h4></div></div><br>

<!-- Form Card -->
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<form method="post" action="login.php">
<div class="form-group">
<h1> </h1>
<label for="username">User Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Username"></div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password"></div><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>
</form> </div></div><br>
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<a href="login.php?create=create" class="card-title"> New User? Sign up here.</a>
 	</div>
 </div><br></div>
</body>
</html>
<?php
        }
        
// if the username or password fields are blank        
        }
        
        else { $msg = 'Username and password fields cannot be blank';
        ?>
<?php include 'header.html';?>
<body>
<div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title"> Login Below</h4>
<h4 class="card-title bg-danger"> <?php echo $msg; ?></h4></div></div><br>

<!-- Form Card -->
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<form method="post" action="login.php">
<div class="form-group">
<h1> </h1>
<label for="username">User Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Username"></div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password"></div><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>
</form> </div></div><br></div>
</body>
</html>
 

<?php }
} else {

	// if the form hasn't been submitted
 $msg='';
 ?>
<?php include 'header3.html'; ?>
<body>
 <div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title"> Login Below</h4>
<h4 class="card-title"> <?php echo $msg; ?></h4></div></div><br>

<!-- Form Card -->
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<form method="post" action="login.php">
<div class="form-group">
<h1> </h1>
<label for="username">User Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Username"></div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password"></div><br><br>
<button type="submit" name="submit" class="btn btn-secondary">Submit</button>
</form> </div></div><br>
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<a href="login.php?create=create" class="card-title"> New User? Sign up here.</a>
 	</div>
 </div><br>

</div>

</form>



<?php }  

include 'footer.php';
?>