<?php
//Create a variable called yourName.  Assign it a value of your name.
$yourName = 'Kevin Cook';

//Display the assignment name in an h1 element on the page. Include the elements in your output. 
echo "<h1> Unit-3 PHP Basics </h1>";

//Create the following variables:  number1, number2 and total.  Assign a value to them.  
//Display the value of each variable and the total variable when you add them together. 

$number1 = 5;
$number2 = 4;
$total = $number1+$number2;
echo "The value of number1 is: ".$number1." <br>";
echo "The value of number2 is: ". $number2." <br>";
echo "When you add these you get: ".$total." <br>";


echo "<script> const js_array= new Array(); </script>\n";

?>


<html>
<!-- Use HTML to put an h2 element on the page. Use PHP to display your name inside the element using the variable. -->
<h2><?php print $yourName; ?>  </h2>


<script>

<?php
//Create a PHP variable that is an array containing the values 'PHP', 'HTML' and 'Javascript'. Then, use a PHP loop to iterate through the array and create a javascript array that contains those values. Lastly, write a //javascript script that displays the values of the array on the page.


$langs= array("PHP", "HTML", "Javascript");

for($x=0; $x<count($langs); $x++){
echo "js_array.push('".$langs[$x]."'); \n";
}
?>

for (var i=0; i<js_array.length; i++){
document.write("<h2>"+js_array[i]+"</h2>");
}

</script>
</html>