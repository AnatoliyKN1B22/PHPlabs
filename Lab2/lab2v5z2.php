<?php

$bool_true = true;
$bool_false = false;

$num_true = (int)$bool_true; 
$num_false = (int)$bool_false; 

$sum = $num_true + $num_false;
$product = $num_true * $num_false;
$difference = $num_true - $num_false;

echo "Початкові значення:<br>";
echo "true: " . ($bool_true ? 'true' : 'false') . "<br>";
echo "false: " . ($bool_false ? 'true' : 'false') . "<br><br>";

echo "Після перетворення в числа:<br>";
echo "true як число: " . $num_true . "<br>";
echo "false як число: " . $num_false . "<br><br>";

echo "Результати обчислень:<br>";
echo "Сума: " . $sum . "<br>";
echo "Добуток: " . $product . "<br>";
echo "Різниця: " . $difference . "<br>";
?>