<?php

function printGrid($grid)
{
    $len = count($grid);
    foreach ($grid as $line)
    {
        foreach ($line as $square)
        {
            echo "[$square]";
        }
        echo "\n";
    }
}

//parse file into a 2 dimensional array
function toGrid($filename)
{
    $grid = [];
    $file = fopen($filename, 'r');
    if (!$file)
        return false;
    while (($line = fgets($file)) !== false)
    {
        $grid[] = str_split(trim($line));
    }
    fclose($file);
    return $grid;
}

// check whether the given initial grid from config file is valid
function validInitialGrid($grid, $size)
{
    // chekc nb rows
    if (count($grid) != $size)
        return false;
    foreach ($grid as $row)
    {
        // check nb columns
        if (count($row) != $size)
            return false;
        //check square value
        foreach ($row as $square)
        {
            if ($square != '.') 
            {
                $unicode_point = mb_ord($square);
                if (($unicode_point <= mb_ord('0')) || ($unicode_point > (mb_ord('0') + $size)))
                    return false;
            }
        }
    }
    return true;
}


function absentOnLine($char, $grid, $line_index)
{
    $line = $grid[$line_index];
    foreach ($line as $square)
    {
        if ($square == $char)
            return false;
    }
    return true;
}
function absentOnCol($char, $grid, $col_index)
{
    $j = count($grid);
    for ($i = 0; $i < $j; $i++)
    {
        $square = $grid[$i][$col_index];
        if ($square == $char)
            return false;
    }
    return true;
}
//$i bloc number on line
//$j bloc number on col
function absentOnBloc($char, $grid, $i, $j)
{
    //9=>3, 4=>2
    $bloc_len = sqrt(count($grid));
    $i_start = $i-($i%$bloc_len);
    $i_end = $i_start + $bloc_len - 1;
    $j_start = $j-($j%$bloc_len);
    $j_end = $j_start + $bloc_len - 1;

    // echo "bloc_i: $bloc_i\n";
    // echo "bloc_j: $bloc_j\n";
    for ($i = $i_start; $i <= $i_end; $i++)
    {
        for ($j = $j_start; $j <= $j_end; $j++)
        {
            if ($grid[$i][$j] == $char)
                return false;
        }
    }
    return true;
}

function positionToCoord($position, $grid)
{
    $len = count($grid);

    $i = intval($position / $len);
    $j = $position % $len;
    return ['i' => $i, 'j' => $j];
}

// coord = ['x' => $x, 'j'=> $j]
function coordToPosition($coord, $grid)
{
    $len = count($grid);

    return ($coord['i'] * $len) + $coord['j'];
}

function isPlaceable($char, $grid, $coord)
{
    if (absentOnLine($char, $grid, $coord['i'])
        && absentOnCol($char, $grid, $coord['j'])
            && absentOnBloc($char, $grid, $coord['i'], $coord['j'])
        )
        return true;
    return false;
}