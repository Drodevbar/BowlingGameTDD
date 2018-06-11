<?php

namespace BowlingGame\Tests;

use BowlingGame\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /**
     * @var Game
     */
    private $game;

    public function setUp() : void
    {
        $this->game = new Game();
    }

    /**
     * @test
     */
    public function itHandlesGutterGame() : void
    {
        $this->rollMany(20, 0);

        $this->assertEquals(0, $this->game->getScore());
    }

    /**
     * @test
     */
    public function itHandlesAllOnesScores() : void
    {
        $this->rollMany(20, 1);

        $this->assertEquals(20, $this->game->getScore());
    }

    /**
     * @test
     */
    public function itHandlesASpare() : void
    {
        $this->scoreSpare(9);
        $this->game->roll(3);
        $this->rollMany(17, 0);

        $this->assertEquals(16, $this->game->getScore());
    }

    /**
     * @test
     */
    public function itHandlesAStrike() : void
    {
        $this->game->roll(10);
        $this->game->roll(3);
        $this->game->roll(4);
        $this->rollMany(16, 0);

        $this->assertEquals(24, $this->game->getScore());
    }

    /**
     * @test
     */
    public function itHandlesPerfectGame() : void
    {
        $this->rollMany(12, 10);

        $this->assertEquals(300, $this->game->getScore());
    }

    private function rollMany(int $rolls, int $pins) : void
    {
        for ($i = 0; $i < $rolls; $i++) {
            $this->game->roll($pins);
        }
    }

    private function scoreSpare(int $firstRollScore) : void
    {
        $this->game->roll($firstRollScore);
        $this->game->roll(10 - $firstRollScore);
    }
}
