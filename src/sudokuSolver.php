<?php

require_once 'src/grid.php';

function isValidSudoku(&$grid, $position)
{
    // echo "On test la position $position \n";
    $len = count($grid);
    // nb squares + 1
    if ($position == $len*$len)
        return true;
    // on récupère les coord
    $coord = positionToCoord($position, $grid);
    $i = $coord['i'];
    $j = $coord['j'];
    // Si la case n'est pas vide, on passe à la suivante (appel récursif)
    if ($grid[$i][$j] != '.')
       return isValidSudoku($grid, $position + 1);
    // Si la case est vide on lui cherche une valeur  possible
    // énumération des valeurs possibles
    for ($k = 1; $k <= $len; $k++)
    {
        // Si la valeur respecte les conditions
        $char = mb_chr($k +  mb_ord('0'));
        if (isPlaceable($char, $grid, $coord))
        {
            // echo "Position $position, char: $char est plaçable\n";
            $grid[$i][$j] = $char;
            if (isValidSudoku($grid, $position + 1) )
                return true;  // Si le choix est bon, plus la peine de continuer, on renvoie true :)
        }
    }
    // pas de solution trouvée, on réinitialise la case
    $grid[$i][$j] = '.';
    // the end.
    return false;
}
