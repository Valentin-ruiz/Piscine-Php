#!/usr/bin/php
<?php

    $file = file_get_contents($argv[1]);
    $file = str_replace("\n", "AAA", $file);
    function title($matches)
    {
      return ($matches[1].strtoupper($matches[2]).$matches[3]);
    }

    function link_upper($matches)
    {
      return ($matches[1].strtoupper($matches[2]).$matches[3]);
    }

    function wholelink($matches)
    {
      $matches[0]= preg_replace_callback("/( title=\")(.*?)(\")/", "title", $matches[0]);
      $matches[0] = preg_replace_callback("/(>)(.*?)(<)/", "link_upper", $matches[0]);
      $matches[0] = preg_replace_callback("/(>)(.*?)(<)/", "link_upper", $matches[0]);
      return ($matches[0]);
    }
    $res = preg_replace_callback("/(<a )(.*?)(<\/a>)/", "wholelink", $file);
    $res = str_replace("AAA", "\n", $res);
    echo $res;
?>