<?php

namespace Adventofcode\Day6\View\day\Six\Utils;

use Adventofcode\Day6\View\day\Six\Enum\Direction;

class Player extends Cord
{
    public function __construct(
        public int       $x,
        public int       $y,
        public Direction $direction = Direction::UP
    )
    {
        parent::__construct($x, $y);
    }

    public function move(Direction $direction): void
    {
        switch ($direction) {
            case Direction::UP:
                $this->y--;
                break;
            case Direction::DOWN:
                $this->y++;
                break;
            case Direction::LEFT:
                $this->x--;
                break;
            case Direction::RIGHT:
                $this->x++;
                break;
        }
    }

    public function nextDirection(): void
    {
        switch ($this->direction) {
            case Direction::UP:
                $this->direction = Direction::RIGHT;
                break;
            case Direction::DOWN:
                $this->direction = Direction::LEFT;
                break;
            case Direction::LEFT:
                $this->direction = Direction::UP;
                break;
            case Direction::RIGHT:
                $this->direction = Direction::DOWN;
                break;
        }
    }
}