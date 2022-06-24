<?php
use PHPUnit\Framework\TestCase;

require_once 'src/sudokuSolver.php';

class SudokuSolverTest extends TestCase
{

    public function testisValidSudoku()
    {
        $grid = [
            ['.', '4', '.', '.'],
            ['.', '1', '.', '.'],
            ['.', '3', '2', '.'],
            ['4', '2', '.', '.']
        ];
        $this->assertTrue(isValidSudoku($grid, 0));
        printGrid($grid);
    }
}