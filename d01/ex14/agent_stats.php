#!/usr/bin/php
<?php
fgets(STDIN);
$i = 0;
$n = 0;
while($line = fgets(STDIN))
{
  $read = explode(";", $line);
  $arr[$i] = array("User" => $read[0], "Note" => $read[1], "Noteur" => $read[2], "Feedback" => $read[3]);
  $i++;
}
sort($arr);

if(!strcmp($argv[1], "moyenne"))
{
  foreach($arr as $key => $value)
  {
    if(strcmp($value["Noteur"], "moulinette") != 0 && ($value["Note"] != NULL))
    {
      $total += $value["Note"];
      $n++;
    }
  }
  $res = $total / $n;
  print("$res\n");
}
if(!strcmp($argv[1], "moyenne_user"))
{
  foreach ($arr as $key => $value)
  {
    if (!$tab[$value["User"]])
    {
      $tab[$value["User"]] = array();
      $tab[$value["User"]]["grades"] = array();
    }
    if ($value["Note"] != NULL && $value["Noteur"] != "moulinette")
      array_push($tab[$value["User"]]["grades"], $value["Note"]);
  }
  foreach($tab as $user => $value)
  {
    $total = 0;
    foreach($value["grades"] as $key => $grade)
    {
      $total += $grade;
      $res = $total / ($key + 1);
    }
    print("$user:$res\n");
  }
}
if(!strcmp($argv[1], "ecart_moulinette"))
{
  foreach ($arr as $key => $value)
  {
    if (!$tab[$value["User"]])
    {
      $tab[$value["User"]] = array();
      $tab[$value["User"]]["grades"] = array();
    }
    if ($value["Note"] != NULL && $value["Noteur"] != "moulinette")
      array_push($tab[$value["User"]]["grades"], $value["Note"]);
    if ($value["Note"] != NULL && $value["Noteur"] == "moulinette")
      $tab[$value["User"]]["mou"] = $value["Note"];
  }
  foreach($tab as $user => $value)
  {
    $total = 0;
    foreach($value["grades"] as $key => $grade)
    {
      $total += $grade;
      $res = $total / ($key + 1) - $value["mou"];
    }
    print("$user:$res\n");
  }
}
?>