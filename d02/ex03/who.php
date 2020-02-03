#!/usr/bin/php
<?php
  date_default_timezone_set('Europe/Paris');
  $who = fopen("/var/run/utmpx", 'rb');
  $result = array();
  $i = 0;
  while ($line = fread($who, 628))
  {
    $arr = unpack("a256user/a4identifer/a32tty/ipid/itype/I2time/a256hostname/i16pad", $line);
    $arr = str_replace("\0", "", $arr);
    if ($arr["type"] == 7)
    {
      $result[$i] = $arr["user"]."   ".$arr["tty"]."  ".date("M j H:i", $arr["time1"])."\n";
      $i++;
    }
  }
  $result = array_unique($result);
  sort($result);
  foreach ($result as $elem) {
    echo $elem;
  }
  fclose($who);
?>
