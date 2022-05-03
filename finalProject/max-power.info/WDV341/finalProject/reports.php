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

$today =date('Y-m-d');

if(isset($_GET['month'])){

$month = $_GET['month'];
$monthNum = date("m", strtotime($month));
$beginDate = date('Y-'.$monthNum.'-01');
$endDate = date('Y-m-t', strtotime($beginDate));
$prevmonth = $monthNum-1;
$nextmonth = ($monthNum)+1;
if($nextmonth==13){$nextmonth='01';};
if ($prevmonth==0){$prevmonth=12;};

$sqlCount="SELECT COUNT(id) from sales where saleDate BETWEEN  "."'".$beginDate."'"." and "."'".$endDate."'".";";
$sqlSum = "Select IFNULL(SUM(Amount), 0) as sum from sales where saleDate BETWEEN  "."'".$beginDate."'"." and "."'".$endDate."'".";";

} 
else {$month=date('F');
$monthNum = date("m", strtotime($month));
$beginDate = date('Y-'.$monthNum.'-01');
$endDate = date('Y-m-t', strtotime($beginDate));
$prevmonth = $monthNum-1;
$nextmonth = ($monthNum)+1;
if($nextmonth==13){$nextmonth='01';};
if ($prevmonth==0){$prevmonth=12;};

$sqlCount="SELECT COUNT(id) from sales where saleDate BETWEEN  "."'".$beginDate."'"." and "."'".$endDate."'".";";
$sqlSum = "Select IFNULL(SUM(Amount), 0) as sum from sales where saleDate BETWEEN  "."'".$beginDate."'"." and "."'".$endDate."'".";";


}

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

<body>

<div class="container d flex justify-content-center">
<!-- Title Card -->
<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<h4 class="card-title"><?echo $month ?>  Reports</h4>
 	</div>
 </div><br>

<!-- Live Data --> 
<div class="card  text-white  text-center bg-dark  ">
	<div class="card-body  ">
  		<table class="table  text-white  text-center">
  			<thead>
   				<tr>
      					<th scope="col"> Current Contracts for <?php echo $month ?></th>
      					<th scope="col">Current Revenue for <?php echo $month ?></th>
   				</tr>
  			</thead>
  		<tbody>
    			<tr>
      				<td><?php echo $resultCount; ?></td>
      				<td>$<?php echo $sum; ?></td>
    			</tr>
  		</tbody>
		</table>
	</div>
</div><br>
 
	<div class="panel-group  ">
 		<div class="panel">
 			<div class="panel-heading"><p class="panel-title"></p>
			</div>
			<div class="card   text-white  text-center bg-dark">
				<div class="card-body">
					<a data-toggle="collapse" href="#collapse1"> <?echo $month ?> Contracts</a>
						<div id="collapse1" class="panel-collapse collapse">
							<ul class="list-group text-right">



<?php
				
// gets all data for report
$sql="SELECT *  from sales where saleDate BETWEEN "."'".$beginDate."'"." and "."'".$endDate."'".";";			
$result = $conn->prepare($sql);
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
if($result->rowCount()>0){	


while($rows = $result->fetch()){

echo '<li class="list-group-item   text-white  text-left bg-dark"><a href="profile.php?id='.$rows['id'].'">'.$rows['name']." - $".$rows['amount'].'	Status - '.$rows['status'].'</a></li>';

}
	}
else
{echo '<li class="list-group-item   text-white  text-left bg-dark"> No results </li>';};

?>
							</ul>
							
						</div>
				</div>
			</div>
		</div>
	</div><br>
  
<div class="card text-white  text-center bg-dark mb-3">
 <div class="card-body">
 <h5> To see previous months revenue use the selector below </h5>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Previous Months
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="reports.php?month=January">January</a>
    <a class="dropdown-item" href="reports.php?month=February">February</a>
    <a class="dropdown-item" href="reports.php?month=March">March</a>
    <a class="dropdown-item" href="reports.php?month=April">April</a>
    <a class="dropdown-item" href="reports.php?month=May">May</a>
    <a class="dropdown-item" href="reports.php?month=June">June</a>
    <a class="dropdown-item" href="reports.php?month=July">July</a>
    <a class="dropdown-item" href="reports.php?month=August">August</a>
    <a class="dropdown-item" href="reports.php?month=September">September</a>
    <a class="dropdown-item" href="reports.php?month=October">October</a>
    <a class="dropdown-item" href="reports.php?month=November">November</a>
    <a class="dropdown-item" href="reports.php?month=December">December</a>
    
</div>


      



	</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>