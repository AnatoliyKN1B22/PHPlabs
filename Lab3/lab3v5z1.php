<?php

$sum = 0;       
$number = 1;    

do {
    $sum += $number;
    $number++;
} while ($number <= 100);

echo "Сума чисел від 1 до 100: " . $sum . "<br>";
?>