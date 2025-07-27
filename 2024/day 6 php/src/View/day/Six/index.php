<?php

declare(strict_types=1);

namespace Adventofcode\Day6\View\day\Six;

use Adventofcode\Day6\View\day\Six\Utils\Cord;
use Adventofcode\Day6\View\day\Six\Utils\Player;
use Adventofcode\Day6\View\day\Six\Utils\Grid;
use Adventofcode\Day6\View\day\Six\Enum\Direction;

$file = __DIR__ . '/example.txt';

$grids = [];
$player = null;
$playerHistory = [];
$gameIsOver = false;


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
    // Check if the next position is within bounds and not an obstacle
    if ($x < 0 || $y < 0 || $y >= count($grid) || $x >= count($grid[0])) {
        return false; // Out of bounds
    }
    // echo "<p>Checking next move for player at ($x, $y)</p>";

    return is_a($grid[$y][$x], Grid::class) && $grid[$y][$x]->obstacle; // Return true if the next cell is not an obstacle
}


foreach (file($file) as $line) {
    $grids[] = str_split(trim($line));
}

// Initialize the grid with obstacles and player
for ($y = 0; $y < count($grids); $y++) {
    for ($x = 0; $x < count($grids[$y]); $x++) {
        if ($grids[$y][$x] === '#') {
            // Initialize obstacle grid cell
            $grids[$y][$x] = new Grid($x, $y, true);
        } elseif ($grids[$y][$x] === '^') {
            // Initialize player at the first position with a direction
            $player = new Player($x, $y, Direction::UP);
            $grids[$y][$x] = $player;
        } else {
            // Initialize empty grid cell
            $grids[$y][$x] = new Grid($x, $y);
        }
    }
}


while (!$gameIsOver) {
    // Game logic would go here, such as moving the player or checking for collisions
    // For now, we will just break the loop to avoid an infinite loop
//    $grid = $grids[$player->y][$player->x] ?? null;

    // Check if player is defined and within bounds
    [
        $x,
        $y
    ] = [$player->x, $player->y];

    if (nextPlayerCanMove($player, $grids)) {
        // If the grid cell is an obstacle, change direction
        $player->nextDirection();
    }
    $player->move($player->direction);
    $playerHistory[] = new Cord($player->x, $player->y);

    // Check if player is out of bounds
    if ($x <= 0 || $y <= 0 || $y >= count($grids) || $x >= count($grids[0])) {
        print_r("Player is out of bounds at ($x, $y). Game Over!\n");
        $gameIsOver = true;
        continue;
    }

    // Update player position in the grid
    $grids[$y][$x] = $player;
}


if (!file_exists($file)) {
    die("File not found: $file");
}

echo "<h1>Day Six</h1>";

echo "<h2>Player History</h2>";
array_pop($playerHistory); // Remove the last move which is out of bounds
array_pop($playerHistory); // Remove the last move which is out of bounds
echo count($playerHistory) . " moves made.<br>";
$uniqueCords = getAllUniqueCords($playerHistory);
echo count($uniqueCords) . " unique coordinates visited.<br>";

// Render the grid
foreach ($grids as $row) {
    echo "<div class='row'>";
    foreach ($row as $grid) {
        if (is_a($grid, Player::class)) {
            echo "<div class='col player'><i class=\"fa-solid fa-user\"></i></div>";
        } elseif ($grid->obstacle) {
            echo "<div class='col obstacle'><i class=\"fa-solid fa-dumpster\"></i></div>";
        } else {
            echo "<div class='col'></div>";
        }
    }
    echo "</div>";
}


/**
 * Get all unique coordinates from the player history.
 *
 * @param Cord[] $cords
 * @return Cord[]
 */
function getAllUniqueCords(array $cords): array
{
    $uniqueCords = [];
    $seenCords = [];

    foreach ($cords as $cord) {
        // Skapa en unik nyckel för varje objekt baserat på dess x och y värden
        $key = $cord->x . ',' . $cord->y;

        // Om nyckeln inte redan finns i $seenCords, lägg till objektet i $uniqueCords
        if (!isset($seenCords[$key])) {
            $uniqueCords[] = $cord;
            $seenCords[$key] = true; // Markera att vi har sett detta objekt
        }
    }

    return $uniqueCords;
}
