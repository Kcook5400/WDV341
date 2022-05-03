<?php
session_start(); // start session

if($_SESSION['validUser']!=true){header("Location: login.php");exit();}

if (isset($_SESSION['admin']))	{include 'header2.html';}	else	{include 'header.html';	}


?>

<div class="container d flex justify-content-center">	
<div class="card text-white  text-left bg-dark mb-3">
<div class="card-body text-center">
<h4 class="card-title">Seafoam User Table</h4><br>		
<table class="table table-hover text-white">
<tbody>
<?php 
include 'connectPDO.php';
$sql = "Select * from user;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);	?>
<th scope="col" >User </th>
<th scope="col" > Password </th>
<th scope="col" > Admin </th>
<th scope="col" > Edit </th>
<th scope="col" > Delete </th>
<?php	while($row=$stmt->fetch()){ 
echo '<tr>';
echo '<td>'.$row['name'].'</a></td>';
echo '<td>'.$row['password'].'</a></td>';
echo '<td>';
if ($row['admin']==true){echo 'Yes';} else{echo 'No';};
echo '</a></td>';
echo '<td><a href="adminEditUser.php?id='.$row['id'].'">Edit</a></td>';
echo '<td><a href="adminDeleteUser.php?id='.$row['id'].'">Delete</a></td>';
echo '</tr>';
	}	?>
</table>
<h5> To add a user <a href="adminAddUser.php"> click here </a> </h5><br>
<h5> Or to go back to your Admin panel <a href="admin.php"> click here </a> </h5><br>

</div>
</div>
</div>

<?php include 'footer.php'; ?>