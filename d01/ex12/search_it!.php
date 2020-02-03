#!/usr/bin/php
<?php
  if ($argc > 2)
  {
    $i = 0;
    $arr = array();
    $result = array();
    while ($i <= count($argv))
    {
      $arr = preg_split('/:/', $argv[$i + 2]);
      $result[$arr[0]] = $arr[1];
      $i++;
    }
    if (array_key_exists($argv[1], $result)) {
      echo $result[$argv[1]]."\n";
    }
  }
?>