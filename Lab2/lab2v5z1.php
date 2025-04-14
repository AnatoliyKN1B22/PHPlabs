<?php

$alpha_degrees = 30; 
$radius = 7;         

$alpha_radians = deg2rad($alpha_degrees);

$area = ($alpha_radians * pow($radius, 2)) / 2;

echo "Кут α: " . $alpha_degrees . " градусів<br>";
echo "Радіус r: " . $radius . "<br>";
echo "Площа S: " . round($area, 2) . "<br><br>";
?>