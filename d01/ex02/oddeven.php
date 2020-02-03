#!/usr/bin/php
<?php
    while(1)
    {
        echo "Entrez un nombre: ";
        $num = trim(fgets(STDIN));
        if (feof(STDIN))
        {
            echo "\n";
            exit;
        }
        if (is_numeric($num))
        {
            $parity = ($num % 2 == 0) ? ("Pair") : ("Impair");
            echo "Le chiffre ".$num." est ".$parity;
        }
        else
        {
            echo "'".$num."'"." n'est pas un chiffre";
        }
        echo "\n";
    }
?>