#!/usr/bin/php
<?php
function ft_split($str)
{
  $tab = explode(" ", $str);
  sort($tab);
  return($tab);
}

$e = array();
foreach ($argv as $arg) {
  if ($arg != $argv[0])
  {
    $tab = ft_split(trim($arg));
    $e = array_merge($e, $tab);
  }
}
sort($e);
foreach ($e as $ele) {
  echo $ele;
  echo "\n";
}
?>