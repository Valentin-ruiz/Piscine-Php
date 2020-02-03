#!/usr/bin/php
<?php
  if ($argc > 1)
  {
    $res = preg_replace("/[ \t]{2,}/", " ", trim($argv[1]));
    echo $res."\n";
  }
?>