<?php include 'connectPDO.php';

// create the rowid parameter, sql statement, connect to database, bind params, execute and set fetch mode, then fetch one result
$rowid=1;
$sql = "SELECT id, name, description, presenter, date, time from wdv341_events where id=:rowid;";
$result = $conn->prepare($sql);
$result->bindParam(':rowid',$rowid);
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
$row = $result->fetch();

// create a class

    $eventObj = new stdClass(); 

// set the values of the class and echo it

    $eventObj->eventid = $row['id']; 
    $eventObj->eventName = $row['name'];
    $eventObj->eventDescription = $row['description'];  
    $eventObj->eventPresenter = $row['presenter'];  
    $eventObj->eventDate = $row['date']; 
    $eventObj->eventTime = $row['time'];  

    $eventJSON = json_encode($eventObj);

    echo $eventJSON;