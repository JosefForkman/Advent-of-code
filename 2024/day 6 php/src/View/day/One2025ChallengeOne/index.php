<?php

declare(strict_types=1);

namespace Adventofcode\Day2025\View\day\One2025ChallengeOne;

$exampleFilePath = __DIR__ . '/example.txt';
$inputFilePath = __DIR__ . '/input.txt';
$lines = [];
$startingPosition = 50;
$password = 0;


if (!file_exists($inputFilePath)) {
    die("File not found: $inputFilePath");
}

foreach (file($inputFilePath) as $line) {
    $lines[] = trim($line);
}

$patternLaters = '/[0-9]/i';
$patternNumber = '/[a-z]/i';
$lines = array_map(function ($line) use ($patternLaters, $patternNumber) {

    $letter = preg_split($patternLaters, $line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $number = preg_split($patternNumber, $line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    if (!$letter || !$number) {
        return null;
    }


    if ($letter[0] == "L") {
        return (int) -$number[0];
    }
    return (int) $number[0];
}, $lines);

array_reduce($lines, function ($carry, $item) use (&$password) {
    $carry += $item % 100;
    $t = abs(round($item / 100, 0, PHP_ROUND_HALF_DOWN));

    if ($carry < 0) {
        $carry = $carry + 100;
    } elseif ($carry >= 100) {
        $carry = $carry - 100;
    }

    echo "The dial is rotated $item to point at $carry" . "<br>";

    if ($carry == 0) {
        $password += 1;
    }

    return $carry;
}, $startingPosition);



echo "<pre>";
print_r($password);
echo "</pre>";
