<?php

//Get the input from a txt file...
$input = trim(file_get_contents('./input.txt'));


function reduce_polymer($str)
{
    $index = strlen($str);
    while ($index > 0) {
        $index--;
        if ($str[$index] == $str[$index + 1]) {
            continue;
        }
        if (strtolower($str[$index]) == strtolower($str[$index + 1])) {
            $str = substr_replace($str, '', $index, 2);
        }
    }
    return strlen($str);
}

echo 'Initial reduction: ' . reduce_polymer($input) . PHP_EOL;

$counts = [];
foreach (range('a', 'z') as $letter) {
    $copy = $input;
    $copy = str_ireplace($letter, '', $copy);
    $counts[$letter] = reduce_polymer($copy);
}

echo 'Shortest polymer length: ' . min($counts);
