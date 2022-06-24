<?php
use PHPUnit\Framework\TestCase;

require 'src/grid.php';

class GridHelper extends TestCase
{
    public function testValidInitialGrid_1()
    {
        // given
        $grid = array(
            array('.', '4', '.', '.'),
            array('.', '1', '.', '.'),
            array('.', '3', '2', '.'),
            array('4', '2', '.', '.'),
        );
        $size = 4;
        $actual = validInitialGrid($grid, $size);
        $this->assertTrue($actual);
    }
    public function testValidInitialGrid_2()
    {
        // given
        $grid = array(
            array('.', '?', '.', '.'),
            array('.', '?', '.', '.'),
            array('.', '?', '?', '.'),
            array('?', '?', '.', '.'),
        );
        $size = 4;
        $actual = validInitialGrid($grid, $size);
        $this->assertFalse($actual);
    }
}