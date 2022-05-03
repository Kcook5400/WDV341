<?php 

session_start(); 

if($_SESSION['validUser']!=true){

header("Location: login.php");
exit();}



if ($_SESSION['admin']==true){

include 'header2.html';
 
 }
 
 else {
 
include 'header.html';
}

// get live data
$today =date('Y-m-d');

$sqlCount = "Select count(id) from sales where status='Active' and  saleDate <= "."'".$today."'".";";
$sqlSum = "Select IFNULL(SUM(Amount), 0) as sum from sales where status='Active' and  saleDate <= "."'".$today."'".";";
include 'connectPDO.php';
$stmt = $conn->prepare($sqlCount);
$stmt ->execute();
$resultCount = $stmt->fetchColumn();
$resultSum = $conn->prepare($sqlSum);
$stmt2 = $conn->prepare($sqlSum);
$stmt2->execute();
$resultSum = $stmt2->fetch(PDO::FETCH_ASSOC);
if(empty($resultSum)){$sum=0;}else{$sum = $resultSum['sum'];}



?>

<div class="container d flex justify-content-center">

<!-- Title Card -->
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<h4 class="card-title"> Live  Dashboard</h4>
 	</div>
 </div><br>

<!-- Live Data --> 
<div class="card  ">
	<div class="card-body  text-white bg-dark  ">
  		<table class="table  text-white  text-center">
  			<thead>
   				<tr>
      					<th scope="col"> Total Contracts</th>
      					<th scope="col">Current Revenue</th>
   				</tr>
  			</thead>
  		<tbody>
    			<tr>
      				<td><?php echo $resultCount;  ?></td>
      				<td>$<?php echo $sum; ?></td>
    			</tr>
  		</tbody>
		</table>
	</div>
</div><br>
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
<h4 class="card-title"> What do you want to do? </h4>
  	</div>
 </div><br>     
      
      <!-- Actions Card -->
<div class="card text-center bg-dark  text-white">
    <div class="card-body text-center bg-dark  text-white">

      
      
<a href="reports.php" class="btn btn-primary btn-lg" role="button">See Report Detail</a>&emsp;

<a href="search.php" class="btn btn-primary btn-lg" role="button">Search for a Customer</a>&emsp; 

<a href="salesNav.php" class="btn btn-primary btn-lg" role="button"> Manage Sales</a>



	</div>
</div>









</div>
<?php include 'footer.php'; ?>