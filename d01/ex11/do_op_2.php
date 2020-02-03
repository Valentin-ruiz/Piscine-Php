#!/usr/bin/php
<?php
  if ($argc != 2) {
    echo "Incorrect Parameters\n";
    exit();
  }
  $params = "";
  $params = preg_replace("/[\s]/", '', $argv[1]);
  $i = 0;
  $num1 = "";
  $oper = "";
  $num2 = "";
  while ($i < strlen($params))
  {
    if ($params[$i] >= '1' && $params[$i] <= '9' && $oper == "") {
      $num1 .= $params[$i];
    }
    if ($params[$i] == "+" || $params[$i] == "-" || $params[$i] == "*" || $params[$i] == "/" || $params[$i] == "%" ) {
      $oper .= $params[$i];
    }
    if ($params[$i] >= '1' && $params[$i] <= '9' && $oper != "") {
      $num2 .= $params[$i];
    }
    $i++;
  }
  if (strlen($num1) + strlen($oper) + strlen($num2) != strlen($params))
  {
    echo "Syntax Error\n";
    exit();
  }
  if ($oper == "+")
    echo $num1 + $num2;
  else if ($oper == "-")
    echo $num1 - $num2;
  else if ($oper == "*")
    echo $num1 * $num2;
  else if ($oper == "/")
    echo $num1 / $num2;
  else if ($oper == "%")
    echo $num1 % $num2;
  echo "\n";
?>