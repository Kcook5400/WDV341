<?php

session_start();  

if (isset($_SESSION['validUser'])){
?>
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
    <div class="container d flex justify-content-center">
       <div class="card">
        <div class="card-body">
        
        <h5> Welcome to your homepage <?php echo $_SESSION['userName']; ?>! </h5>
        
        <a href="logoutHomepage.php"> Click here to log out </a>
        
        </div>
        </div>
</body>
</html>




<?php

}
else {

    header("Location: loginHomepage.php");  }

?>