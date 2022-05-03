<?php
session_start();        //access the current session or start a new session

if( isset($_SESSION['validUser'])){
    //already signed on, go to admin panel
    session_unset();
    session_destroy();
    header("Location: login.php");          
}
else{
    header("Location: login.php");         
}
?>