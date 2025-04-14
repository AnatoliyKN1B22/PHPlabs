<?php

function capitalize($string) {
    if (function_exists('mb_convert_case')) {
        return mb_convert_case(mb_substr($string, 0, 1, 'UTF-8'), MB_CASE_UPPER, 'UTF-8') 
               . mb_substr($string, 1, null, 'UTF-8');
    } else {
        return ucfirst($string);
    }
}

$months = [
    "січень", "лютий", "березень", "квітень", "травень", "червень",
    "липень", "серпень", "вересень", "жовтень", "листопад", "грудень"
];

$capitalizedMonths = array_map('capitalize', $months);

echo "Оригінальний масив:<br>";
print_r($months);

echo "<br>Масив після перетворення:<br>";
print_r($capitalizedMonths);

?>