#!/usr/bin/php
<?php
  function ft_is_alpha(string $str)
  {
    if ($str[0] >= 'A' && $str[0] <= 'Z' || $str[0] >= 'a' && $str[0] <= 'z') {
      return true;
    }
    return false;
  }

  function ft_is_digit(string $str)
  {
    if ($str[0] >= '1' && $str[0] <= '9') {
      return true;
    }
  }

  if ($argc > 1)
  {
    $arr = array();
    $arr2 = array();
    $arr3 = array();
    $arr4 = array();
    $result = array();
    $i = 1;
    while ($i < $argc) {
      $arr = explode(" ", $argv[$i]);
      $result = array_merge($result, $arr);
      $i++;
    }
    $i = 0;
    while ($i < count($result))
    {
      if (ft_is_alpha($result[$i]) == true)
        $arr1[] = $result[$i];
      elseif (ft_is_digit($result[$i]) == true)
        $arr2[] = $result[$i];
      else
        $arr3[] = $result[$i];
      $i++;
    }
    sort($arr1, SORT_NATURAL | SORT_FLAG_CASE);
    sort($arr2, SORT_STRING);
    sort($arr3);
    $i = 0;
    while ($i < count($arr1)) {
      echo $arr1[$i]."\n";
      $i++;
    }
    $i = 0;
    while ($i < count($arr2)) {
      echo $arr2[$i]."\n";
      $i++;
    }
    $i = 0;
    while ($i < count($arr3)) {
      echo $arr3[$i]."\n";
      $i++;
    }
  }
?>