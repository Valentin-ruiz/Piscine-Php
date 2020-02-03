#!/usr/bin/php
<?php
function ft_is_sort($arr)
{
  $array = $arr;
  $count = count($array) - 1;
  sort($array);
  $i = 0;
  while ($i != $count)
  {
    if ($arr[$i] != $array[$i])
      return (FALSE);
    $i++;
  }
return (TRUE);
}
?>