<?php
use PHPUnit\Framework\TestCase;

require_once 'src/grid.php';

class GridTest extends TestCase
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
    public function testAbsentOnLine()
    {
        $grid = [
            ['.', '4', '.', '.'],
            ['.', '1', '.', '.'],
            ['.', '3', '2', '.'],
            ['4', '2', '.', '.']
        ];
        $this->assertTrue(absentOnLine('2', $grid, 0));
        $this->assertFalse(absentOnLine('1', $grid, 1));
        $this->assertFalse(absentOnLine('2', $grid, 3));
    }
    public function testAbsentOnCol()
    {
        $grid = [
            ['.', '4', '.', '.'],
            ['.', '1', '.', '.'],
            ['.', '3', '2', '.'],
            ['4', '2', '.', '.']
        ];
        $this->assertTrue(absentOnCol('2', $grid, 0));
        $this->assertFalse(absentOnCol('1', $grid, 1));
        $this->assertFalse(absentOnCol('2', $grid, 2));
    }
    public function testAbsentOnBloc()
    {
        $grid = [
            ['.', '4', '.', '.'],
            ['.', '1', '.', '.'],
            ['.', '3', '2', '.'],
            ['4', '2', '.', '.']
        ];
        // bloc haut gauche 4 présent
        $this->assertFalse(absentOnBloc('4', $grid, 0, 0));
        // bloc haut droite 4 absent
        $this->assertTrue(absentOnBloc('4', $grid, 0, 3));
        // bloc bas gauche 4 present
        $this->assertFalse(absentOnBloc('4', $grid, 3, 0));
        // bloc bas droite 4 absent
        $this->assertTrue(absentOnBloc('4', $grid, 3, 3));
    }
    public function testPositionToCoord()
    {
        $grid =[
            ['0', '1', '2', '3'],
            ['4', '5', '6', '7'],
            ['8', '9', '10', '11'],
            ['12', '13', '14', '15'],
        ];
        $coord = positionToCoord(0, $grid);
        $this->assertEquals($coord,  ['i' => 0, 'j' => 0]);
        $coord = positionToCoord(1, $grid);
        $this->assertEquals($coord, ['i' => 0, 'j' => 1]);
        $coord = positionToCoord(11, $grid);
        $this->assertEquals($coord, ['i' => 2, 'j' => 3]);
        $coord = positionToCoord(15, $grid);
        $this->assertEquals($coord, ['i' => 3, 'j' => 3]);
    }

    public function testCoordToPosition()
    {
        $grid = [
            ['0', '1', '2', '3'],
            ['4', '5', '6', '7'],
            ['8', '9', '10', '11'],
            ['12', '13', '14', '15'],
        ];
        $pos = coordToPosition(['i' => 0, 'j' => 0], $grid);
        $this->assertEquals($pos, 0);
        $pos = coordToPosition(['i' => 0, 'j' => 1], $grid);
        $this->assertEquals($pos, 1);
        $pos = coordToPosition(['i' => 2, 'j' => 3], $grid);
        $this->assertEquals($pos, 11);
        $pos = coordToPosition(['i' => 3, 'j' => 3], $grid);
        $this->assertEquals($pos, 15);
    }
}