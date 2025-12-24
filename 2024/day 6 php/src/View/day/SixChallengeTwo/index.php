<?php
declare(strict_types=1);

namespace Adventofcode\Day6\View\day\SixChallengeTwo;

use Adventofcode\Day6\View\day\SixChallengeTwo\Enum\GameFileName;
use Adventofcode\Day6\View\day\SixChallengeTwo\Utils\Game;
use Adventofcode\Day6\View\day\SixChallengeTwo\Utils\Grid;

$file = __DIR__. "/" . GameFileName::EXAMPLE->lebel();
$grid = Grid::fromFile($file);

$game = new Game($grid);

$game->run();
$game->drawGame();

//echo "<pre>";
//print_r($game->grid);
//echo "</pre>";