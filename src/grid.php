<?php


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
 
}