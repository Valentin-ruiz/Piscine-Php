#!/usr/bin/php
<?php
  if ($argc > 1) {
    $arr = array();
    $str = preg_replace("/[\s]+/", ' ', $argv[1]);
    $str = trim($str);
    $arr = explode(" ", $str);
    $i = 1;
    while ($i < count($arr)) {
      echo $arr[$i]." ";
      $i++;
    }
    echo $arr[0]."\n";
  }
?>