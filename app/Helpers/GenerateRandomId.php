<?php

namespace App\Helpers;

if (!function_exists('generated_random_id')) {
  function generated_random_id($length = 6)
  {
    $getrandomid = uniqid();
    $res = substr($getrandomid, 0, $length);
    return $res;
  }
}
