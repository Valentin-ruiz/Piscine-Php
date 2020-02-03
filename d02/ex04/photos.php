#!/usr/bin/php
<?PHP
if (empty($argv[1]))
{
  return -1;
}
function error_curl($s, $argc)
{
  $test = curl_init($s);
  curl_setopt($test, CURLOPT_RETURNTRANSFER, 1);
  $exec = curl_exec($test);
  if ($exec == FALSE)
  {
    return (1);
  }
  curl_close($test);
}
if (error_curl($argv[1], $argc))
  return -1;
if ($argc == 2)
{
  $c = curl_init($argv[1]);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  $str = curl_exec($c);
  curl_close($c);
  $tmp = array();
  $imgs = array();
  preg_match_all("/<img[^s]+src\s*=\".[^\"]+/", $str, $tmp);
  foreach ($tmp[0] as $elem)
  {
    $elem = preg_replace("/<img[^s]+src\s*=\"/", "", $elem);
    if (preg_match("/^\//", $elem))
      $elem = $argv[1].$elem;
    array_push($imgs, $elem);
  }
  $stack = explode("/", $argv[1]);
  $dirname = $stack[2];
  $dirname = dirname(__FILE__)."/".$dirname;
  if (!file_exists($dirname))
    mkdir($dirname);
  foreach ($imgs as $i)
  {
    $fd = curl_init($i);
    curl_setopt($fd, CURLOPT_RETURNTRANSFER, 1);
    $str = curl_exec($fd);
    $stack = explode("/", $i);
    $filename = $stack[count($stack) - 1];
    file_put_contents($dirname."/".$filename, $str);
    curl_close($fd);
  }
} else {
  return -1;
}
?>