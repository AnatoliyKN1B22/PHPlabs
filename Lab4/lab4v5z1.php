<?php
$numbers = [34, 12, 89, 5, 67, 23, 91, 4, 17];

rsort($numbers);

echo "Відсортований масив (за спаданням):<br>";
foreach ($numbers as $number) {
    echo $number . "<br>";
}
?>