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

if(isset($_GET['search'])){
$search = $_GET['search'];}
else {$search='';}


?>


<div class="container d-flex justify-content-center">

<div class="card text-white  text-center bg-dark mb-3">
	<div class="card-body">
   		<h4 class="card-title"> Seafoam Customer Search Results</h4>
   		
<table class="table table-hover text-white">
<tbody>

<?php 

if($search=='all'){

if(isset($_GET['user'])){
include 'connectPDO.php';
$sql = "Select * from sales;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
?>
<th>Id </th>
<th scope="col" > Customer </th>
<th scope="col" >Status </th>
<th scope="col" > Edit </th>
<th scope="col"> Delete </th>
<?php 
while($row=$stmt->fetch()){ 




echo '<tr>';
echo '<td>'.$row['id'].'</td>';
echo '<td><a href="profile.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
echo '<td>'.$row['status'].'</td>';
echo '<td> <a href="sales.php?select=edit&id='.$row['id'].'"> Edit <a> </td>';
echo '<td> <a href="adminDeleteProduct.php?id='.$row['id'].'"> Delete <a> </td>';
echo '</tr>';
}
?>

</table>


<h5> Or to go back to your Admin panel <a href="admin.php"> click here </a> </h5><br>
</div>
</div>
</div> 
<?php }else{
include 'connectPDO.php';
$sql = "Select * from sales  where status='Active';";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
?>
<th>Id </th>
<th scope="col" > Customer </th>
<th scope="col" >Status </th>
<th scope="col" > Edit </th>
<th scope="col"> Cancel </th>
<?php 
while($row=$stmt->fetch()){ 




echo '<tr>';
echo '<td>'.$row['id'].'</td>';
echo '<td><a href="profile.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
echo '<td>'.$row['status'].'</td>';
echo '<td> <a href="sales.php?select=edit&id='.$row['id'].'"> Edit <a> </td>';
echo '<td> <a href="sales.php?select=cancel&id='.$row['id'].'"> Cancel <a> </td>';
echo '</tr>';
}
?>

</table>


<h5> To go back and search again <a href="search.php"> click here </a> </h5><br>
</div>
</div>
</div> 
<?php }}



elseif (!empty($_POST['search'])){
include 'connectPDO.php';
$sql = "Select * from sales where name like  '%".$_POST['search']."%' and  status='Active';";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);?>

<th>Id </th>
<th scope="col" > Customer </th>
<th scope="col" >Status </th>
<th scope="col" > Edit </th>
<th scope="col"> Cancel </th>

<?php 
while($row=$stmt->fetch()){ 
echo '<tr>';
echo '<td>'.$row['id'].'</td>';
echo '<td><a href="profile.php?id='.$row['id'].'">'.$row['name'].'</a></td>';
echo '<td>'.$row['status'].'</td>';
echo '<td> <a href="sales.php?select=edit&id='.$row['id'].'"> Edit <a> </td>';
echo '<td> <a href="sales.php?select=cancel&id='.$row['id'].'"> Cancel <a> </td>';
echo '</tr>';
}
?>
</table>
<h5> To go back and search again <a href="search.php"> click here </a> </h5><br>
</div>
</div>
</div> 
<?php }

elseif  (empty($_POST['search'])){ ?>

<h5 class="bg-danger"> No Search term entered </h5><br>

<h5>To see a list of all customers <a href="searchResults.php?search=all"> click here</a> </h5><br>


<h5> To go back and search again <a href="search.php"> click here </a> </h5>

</table>

</div>
</div>
</div>

<?php }
include 'footer.php'; ?>