<?php
declare(strict_types=1);
namespace Adventofcode\Day6\View\day\Six\Utils;
class Cord
{
    public function __construct(
        public int $x,
        public int $y
    )
    {
    }
}