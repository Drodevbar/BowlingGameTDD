<?php

namespace BowlingGame;

class Game
{
    /**
     * @var int[]
     */
    private $score;

    /**
     * @var int
     */
    private $currentRoll;

    public function __construct()
    {
        $this->score = [];
        $this->currentRoll = 0;
    }

    public function roll(int $pins) : void
    {
        $this->score[$this->currentRoll++] = $pins;
    }

    public function getScore() : int
    {
        $finalScore = 0;
        $rollIndex = 0;

        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isSpare($rollIndex)) {
                $finalScore += 10 + $this->getSpareBonus($rollIndex);
                $rollIndex += 2;
            } elseif ($this->isStrike($rollIndex)) {
                $finalScore += 10 + $this->getStrikeBonus($rollIndex);
                $rollIndex++;
            } else {
                $finalScore += $this->sumScoreInFrame($rollIndex);
                $rollIndex += 2;
            }
        }
        return $finalScore;
    }

    private function isSpare(int $index) : bool
    {
        return ($this->score[$index] + $this->score[$index + 1] === 10);
    }

    private function getSpareBonus(int $index) : int
    {
        return $this->score[$index + 2];
    }

    private function isStrike(int $index) : bool
    {
        return $this->score[$index] === 10;
    }

    private function getStrikeBonus(int $index) : int
    {
        return $this->score[$index + 1] + $this->score[$index + 2];
    }

    private function sumScoreInFrame(int $index) : int
    {
        return $this->score[$index] + $this->score[$index + 1];
    }
}
