<?php

function fizzbuzz($number)
{
  $str = null;

  if ($number % 3 == 0) {
    $str .= "Fizz";
  }

  if ($number % 5 == 0) {
    $str .= "Buzz";
  }

  return $str ?? $number;
}


for ($i = 1; $i < 26; $i++) {
  print fizzbuzz($i) . "\n";
}

