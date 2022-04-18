<?php
session_start();  

if( isset($_SESSION['validUser'])){

    $validUser = true;  

    //get username
    $userName = $_SESSION['userName'];
}
else{
    //NOT a valid user display form or process submitted form

    $userName = "";
    $passWord = "";
    
    $validUser = true;
    $msg = "";

    if( isset($_POST['submit'])){
    
        $userName = $_POST['username'];
        $passWord = $_POST['password'];
    
        //connect to the database
    
        include 'connectPDO.php'; 
    
        $sql = "SELECT count(*) FROM event_user WHERE username = :user AND password = :pass";
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
    
        $stmt->execute(); 
        
        $rowCount = $stmt->fetchColumn();   //determine if you are in the table
        
        if($rowCount > 0){
            $validUser = true;
            $_SESSION['validUser'] = true; 
            $_SESSION['userName'] = $userName; 
        }
        else{
            $validUser = false;   
            $msg = "Invalid username or password, please try again!";
        }
    
    }
    else{
        //display the login form

        $validUser = false; 
    }
}
//endif for validUser

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<?php 
if(!$validUser){
    //NOT a valid user then display form
    ?>
    <div class="container d flex justify-content-center">
       <div class="card">
        <div class="card-body">
        <h3>Please Login to access your Admin Functions</h3>
        <p style="color:red"><?php echo $msg;?></p>
        <form method="post" action="#">
            <p>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" placeholder="Username">
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="text" name="password" id="password">
            </p>
            <p>
                <input type="submit" value="Sign On" name="submit" id="submit">
                <input type="reset">
            </p>
        </form>
        
        </div>
        </div>
        </div>
    <?php
}
else{
        //VALID user display Admin
    ?>
    <div class="container d flex justify-content-center">
         <div class="card">
        <div class="card-body">
        <h3>Welcome Back: <?php echo $userName; ?></h3>
        <h3>Administrator Functions</h3> 

        <p>Products</p>
        <ul>
            <li><a href="selfPostingEvent.php">Input Event</a></li>
            <li><a href="deleteProduct.html">Delete Event</a></li>
        </ul>

        <p><a href="logout.php">Logout of Admin Panel</a></p>

</div>
</div>
</div>
    <?php   
}
    ?>


</body>

</html>