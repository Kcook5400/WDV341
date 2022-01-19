<?php

$timeStamp = strtotime("today");

$string = 'BANANA';

// functions

function convertTimeStamp($timeStamp){

echo date('m-d-Y',$timeStamp)."<br>";
}

function convertTimeStamp2($timeStamp){

echo date('d-m-Y',$timeStamp)."<br>";
}

function stringStats($string){

$string = $string;
echo 'The number of character in the string is: '.strlen($string).'<br>';
echo 'Here is the string with no leading or trailing white spaces: '.trim($string).'<br>';
echo 'Here is my string with all lower case letters: '.strtolower($string).'<br>';

$searchString = 'DMACC';




if (str_contains($string, 'DMACC')) {
    echo "The string '.$string.' does not contain 'DMACC'\n";
}

if (str_contains($string, $searchString)|| str_contains($string, strtolower($searchString))) {
    echo 'The string: '.$searchString.' was found in the string<br>';
} else {
    echo 'The string: '.$searchString.' was not found in the string <br>';
}



}


function numberFormat($inputNumber){


$formattedNumber = substr($inputNumber, 0,3).'-'.substr($inputNumber, 4, 3).'-'.substr($inputNumber, 6);

echo '1234567890 formatted to a phone number format looks like this: '.$formattedNumber."<br>";
}

function dollarFormat($inputNumber){

$formattedNumber = '$'.number_format($inputNumber);

echo $formattedNumber;

}


echo 'Here is my time stamp '.$timeStamp.'<br>';


echo 'Here is my string '.$string.'<br>';

echo '1. Create a function that will accept a timestamp and format it into mm/dd/yyyy format. <br>';
convertTimeStamp($timeStamp);
echo '<br>';

echo '2. Create a function that will accept a timestamp and format it into dd/mm/yyyy format to use when working with international dates. <br>';
convertTimeStamp2($timeStamp);
echo '<br>';

echo '3. Create a function that will accept a string input.  It will do the following things to the string:<br>';
echo 'Display the number of characters in the string<br>';
echo 'Trim any leading or trailing whitespace<br>';
echo 'Display the string as all lowercase characters<br>';
echo 'Will display whether or not the string contains "DMACC" either upper or lowercase <br><br>';
	
stringStats('BANANA');
echo '<br>';

echo '4.Create a function that will accept a number and display it as a formatted phone number.   Use 1234567890 for your testing.<br>';

numberFormat(1234567890);
echo '<br>';

echo '5.Create a function that will accept a number and display it as US currency with a dollar sign.  Use 123456 for your testing.<br>';


dollarFormat(123456);
echo '<br>';

?>