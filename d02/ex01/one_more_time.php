#!/usr/bin/php
<?php
  if ($argc != 2)
    exit();
  date_default_timezone_set("Europe/Paris");
  if (preg_match("/^([A-Za-z][a-z]+) (\d\d?) ([A-Za-z][a-z]+) (\d\d\d\d) (\d\d):(\d\d):(\d\d)$/", $argv[1], $time) === 0)
  {
      echo "Wrong Format\n";
      exit();
  }
  $day = strtolower($time[1]);
  if ($day == "lundi" || $day == "mardi" || $day == "mercredi" || $day == "jeudi" || $day == "vendredi" ||
      $day == "samedi" || $day == "dimanche");
  else {
    echo "Wrong Format\n";
    exit ();
  }
  $array = array(
    "janvier" => 1, "fevrier" => 2, "mars" => 3,"avril" => 4, "mai" => 5, "juin" => 6, "juillet" => 7, "aout" => 8, "septembre" => 9, "octobre" => 10, "novembre" => 11 , "decembre" => 12);
  if (!(array_key_exists(strtolower($time[3]), $array))){
    echo "Wrong Format\n";
    exit();
  }
  $month = $array[strtolower($time[3])];
  $seconds = mktime($time[5], $time[6], $time[7], $month, $time[2], $time[4]);
  if (!$seconds)
    echo "Wrong Format\n";
  else
    echo $seconds."\n";
?>