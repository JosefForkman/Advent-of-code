<?php
declare(strict_types=1);

namespace Adventofcode\Day6\View\day\Six\Utils;
class Grid extends Cord
{
    public function __construct(
        public int  $x,
        public int  $y,
        public bool $obstacle = false,
        public bool $visaed = false,
    )
    {
        parent::__construct($this->x, $this->y);
    }
}