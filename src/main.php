<?php

require 'grid.php';
require 'sudokuSolver.php';

function printUsage($argv)
{
    echo 'USAGE:' . PHP_EOL;
    echo 'php ' . $argv[0] . ' nb filename' . PHP_EOL;
    echo 'example: ' . $argv[0] . ' 3 3x3_grid.txt' . PHP_EOL;
    echo 'DESCRIPTION:' . PHP_EOL;
    echo 'nb: grid size' . PHP_EOL;
}

if ($argc < 3)
{
    printUsage($argv);
    exit(1);
}

if (($argv[1] < 2) || ($argv[1]> 3))
{
    fwrite(STDERR, 'le paramètre nb doit être compris entre 2 et 3' . PHP_EOL);
    exit(1);
}

$grid = toGrid($argv[2]);
if (!$grid)
{
    fwrite(STDERR, 'erreur lors de la récupération de la grille' . PHP_EOL);
    exit(1);
}
$nb = intval($argv[1]);

if (!validInitialGrid($grid, $nb * $nb))
{
    fwrite(STDERR, 'Grille initiale non valide' . PHP_EOL);
    exit(1);
}

if (isValidSudoku($grid, 0))
    printGrid($grid);
else
    fwrite(STDERR, 'Grille impossible à résoudre' . PHP_EOL);