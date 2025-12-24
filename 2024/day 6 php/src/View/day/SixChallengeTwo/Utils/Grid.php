<?php
declare(strict_types=1);

namespace Adventofcode\Day6\View\day\SixChallengeTwo\Utils;

use Adventofcode\Day6\View\day\SixChallengeTwo\Enum\GameFileName;

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

    /**
     * Load a grid from a file.
     * @param string $file
     * @return array
     */
    public static function fromFile(string $file): array
    {
        $grids = [];
        if (!file_exists($file)) {
            return $grids;
        }

        foreach (file($file) as $line) {
            $grids[] = str_split(trim($line));
        }

        return $grids;
    }
}