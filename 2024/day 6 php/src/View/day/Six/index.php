<?php

declare(strict_types=1);

namespace Adventofcode\Day6\View\day\Six;

use Adventofcode\Day6\View\day\Six\Utils\Player;
use Adventofcode\Day6\View\day\Six\Utils\Grid;
use Adventofcode\Day6\View\day\Six\Enum\Direction;

use function Adventofcode\Day6\utils\dd;

$file = __DIR__ . '/input.txt';

$grids = [];
$player = null;


/**
 * Check if the next player can move based on the grid and player position.
 * @param Player $player
 * @param (Grid|Player)[][] $grid
 * @return bool
 */
function nextPlayerCanMove(Player $player, array $grid): bool
{
    $y = $player->y;
    $x = $player->x;

    switch ($player->direction) {
        case Direction::UP:
            $y--;
            break;
        case Direction::DOWN:
            $y++;
            break;
        case Direction::LEFT:
            $x--;
            break;
        case Direction::RIGHT:
            $x++;
            break;
    }
    if ($x < 0 || $x >= count($grid[0]) || $y < 0 || $y >= count($grid)) {
        if ($x <= 0 || $x >= count($grid[0]) || $y <= 0 || $y >= count($grid)) {
            return false; // Out of bounds
        }
    }

    return is_a($grid[$y][$x], Grid::class) && $grid[$y][$x]->obstacle; // Return true if the next cell is not an obstacle
}


if (!file_exists($file)) {
    die("File not found: $file");
}

foreach (file($file) as $line) {
    $grids[] = str_split(trim($line));
}

// Initialize the grid with obstacles and player
for ($y = 0; $y < count($grids); $y++) {
    for ($x = 0; $x < count($grids[$y]); $x++) {
        $grid = $grids[$y][$x];
        if ($grids[$y][$x] === '#') {
            // Initialize obstacle grid cell
            $grids[$y][$x] = new Grid($x, $y, true);
        } elseif ($grids[$y][$x] === '^') {
            // Initialize player at the first position with a direction
            $player = new Player($x, $y, Direction::UP);
            $grids[$y][$x] = new Grid($x, $y, visaed: true);
        } else {
            // Initialize empty grid cell
            $grids[$y][$x] = new Grid($x, $y);
        }
    }
}


while (true) {
    // Game logic would go here, such as moving the player or checking for collisions
    // For now, we will just break the loop to avoid an infinite loop

    if ($player === null) {
        print_r("Player not found. Game Over!\n");
        break;
    }
    [
        $x,
        $y
    ] = [$player->x, $player->y];

    // Check if player is out of bounds
    if ($x <= 0 || $x >= count($grids[0]) - 1 || $y <= 0 || $y >= count($grids) - 1) {
        print_r("Player is out of bounds at (x: $x, y: $y). Game Over!\n");
        break;
    }
    if (nextPlayerCanMove($player, $grids)) {
        $player->nextDirection();
    }
    $player->move($player->direction);
    $currentGrid = $grids[$player->y][$player->x];

    if ($currentGrid) {
        $currentGrid->visaed = true; // Mark the current grid as visited
    } else {
        print_r("Current grid is null at ($x, $y). Game Over!\n");
        break;
    }
}




// echo "<h1>Day Six</h1>";

echo "<h2>Player History</h2>";
$movesmade = array_reduce($grids, fn($current, $row) => $current + array_reduce($row, fn($count, $grid) => $count + ($grid->visaed ? 1 : 0), 0), 0);
echo "<p>Moves made: $movesmade</p>";

// Render the grid
foreach ($grids as $row) {
    echo "<div class='row'>";
    foreach ($row as $grid) {
        if ($grid->visaed) {
            echo "<div class='col player'><i class=\"fa-solid fa-user\"></i></div>";
        } elseif ($grid->obstacle) {
            echo "<div class='col obstacle'><i class=\"fa-solid fa-dumpster\"></i></div>";
        } else {
            echo "<div class='col'></div>";
        }
    }
    echo "</div>";
}
