<?php

declare(strict_types=1);
namespace Adventofcode\Day6\View\day\SixChallengeTwo\Enum;

enum Direction: int
{
    case UP = 0;
    case DOWN = 1;
    case LEFT = 2;
    case RIGHT = 3;
}