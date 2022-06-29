<?php

require_once 'src/grid.php';

function isValidSudoku(&$grid, $position)
{
    $len = count($grid);
    // nb squares + 1, notre condition de sortie
    if ($position == $len*$len)
        return true;
    // on récupère les coordonées deu square courant
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
        // Si la valeur respecte les conditions de placabilité
        $char = mb_chr($k +  mb_ord('0'));
        if (isPlaceable($char, $grid, $coord))
        {
            // echo "Position $position, char: $char est plaçable\n";
            $grid[$i][$j] = $char;
            // si l'appel avec position+1 a renvoyé true, c'est que le reste de la grille est valide
            if (isValidSudoku($grid, $position + 1))
                return true;
            // sinon on continue de chercher une autre valeur en laissant la boucle incrementer k 
        }
    }
    // pas de solution trouvée, on réinitialise la case
    $grid[$i][$j] = '.';
    // the end.
    return false;
}
