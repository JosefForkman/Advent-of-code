<?php

declare(strict_types=1);

namespace Adventofcode\Day2025\View\day\One2025ChallengeTwo;

$exampleFilePath = __DIR__ . '/example.txt';
$inputFilePath = __DIR__ . '/input.txt';
$lines = [];
$startingPosition = 50;
$password = 0;


if (!file_exists($exampleFilePath)) {
    die("File not found: $exampleFilePath");
}

foreach (file($exampleFilePath) as $line) {
    $lines[] = trim($line);
}

$lines = array_map(function ($line) {
    $patternNumber = '/[a-z]/i';
    $patternLaters = '/[0-9]/i';

    $letter = preg_split($patternLaters, $line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $number = preg_split($patternNumber, $line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    if (!$letter || !$number) {
        return null;
    }


    if ($letter[0] == "L") {
        return (int)-$number[0];
    }
    return (int)$number[0];
}, $lines);

array_reduce($lines, function ($carry, $item) use (&$password) {
   $total = abs($carry + $item);
   $carry += $item % 100;

   echo $total;

   while ($total > 99) {
       $total -= 99;
       $password++;
   }

   if ($carry < 0) {
       $carry = $carry + 100;
   } elseif ($carry >= 100) {
       $carry = $carry - 100;
   }

   echo "<br>" . "The dial is rotated $item to point at $carry" . "<br>";

   if ($carry == 0) {
       $password += 1;
   }


   return $carry;
}, $startingPosition);


echo "<pre>";
print_r($password);
echo "</pre>";
