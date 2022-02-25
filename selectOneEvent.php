<?php include 'connectPDO.php';

$eventId = 1;


$sql = "Select * from wdv341_events WHERE id=:eventID";

$stmt = $conn->prepare($sql);

$stmt ->bindParam(':eventID',$eventId);

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);







?>

<!DOCTYPE html>
<html>
<head>
<title>Select Events</title>
<style>
span{margin-right:10px;}
</style>
</head>
<body>

<h2>Names in my table </h2>

<?php while($row=$stmt->fetch()){

echo '<p>';
echo '<span>'.$row['name'].'</span>';
echo '<span>'.$row['description'].'</span>';
echo '<span>'.$row['presenter'].'</span>';
echo '<span>'.$row['date'].'</span>';
echo '<span>'.$row['time'].'</span>';
echo '<span>'.$row['date_inserted'].'</span>';
echo '<span>'.$row['date_updated'].'</span>';
echo '</p>';

}
?>



</body>
</html>