<?php
$number = 15;

if ($number % 3 == 0 && $number % 5 == 0) {
    echo "Число $number є кратним і 3, і 5\n";
} elseif ($number % 3 == 0) {
    echo "Число $number є кратним тільки 3\n";
} elseif ($number % 5 == 0) {
    echo "Число $number є кратним тільки 5\n";
} else {
    echo "Число $number не є кратним ні 3, ні 5\n";
}

?>