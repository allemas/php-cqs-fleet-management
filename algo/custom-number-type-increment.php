<?php

$array_1 = [1, 2, 3];
$array_2 = [9, 9];

function increment(array $number): array
{
  $my_index = count($number) - 1;

  $func = function ($number, $index) use (&$func) {
    if ($index < 0) {
      $number[$index] += 1;
      return array_reverse($number);
    }

    if ($number[$index] < 9) {
      $number[$index] += 1;
      return $number;
    }

    $number[$index] = 0;
    return $func($number, $index - 1);
  };

  return $func($number, $my_index);
}

$case1 = increment($array_1);
print_r($case1);

$case2 = increment($array_2);
print_r($case2);

