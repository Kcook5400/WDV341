<?php
session_start(); // start session

if($_SESSION['validUser']!=true){header("Location: login.php");exit();}

if (isset($_SESSION['admin']))	{include 'header2.html';}	else	{include 'header.html';	}


?>

<div class="container d flex justify-content-center">
<div class="card text-white  text-center bg-dark mb-3">
<div class="card-body">
<h4 class="card-title">  Welcome to your Admin Dashboard!</h4>
<h4> What do you want to do? </h4></div></div><br>
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body">
<h4 class="card-title">  Admin Functions</h4><br>
<ul>
<li><a href="adminAddUser.php" class="btn btn-primary btn-lg" role="button">Add a User</a></li><br><br>
<li><a href="adminEditUser.php" class="btn btn-primary btn-lg" role="button">Edit a User</a></li> <br><br>
<li><a href="adminDeleteUser.php" class="btn btn-primary btn-lg" role="button">Delete a User</a></li><br><br>
<li><a href="adminViewAllUsers.php" class="btn btn-primary btn-lg" role="button">View all Users</a></li><br><br>
<li><a href="sales.php?select=enter" class="btn btn-primary btn-lg" role="button">Add a Sale</a></li><br><br>
<li><a href="searchResults.php?search=all&user=true" class="btn btn-primary btn-lg" role="button">Edit/Delete a Sale</a></li><br><br>
<li><a href="searchResults.php?search=all&user=true" class="btn btn-primary btn-lg" role="button">View all Sales Records</a></li> <br><br>
</ul></div></div></div>


<?php include 'footer.php'; ?>










	?>