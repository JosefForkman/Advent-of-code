<?php
declare(strict_types=1);
namespace Adventofcode\Day6\View\day\SixChallengeTwo\Utils;
class Cord
{
    public function __construct(
        public int $x,
        public int $y
    )
    {
    }
}