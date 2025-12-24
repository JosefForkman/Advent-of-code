<?php

declare(strict_types=1);

namespace Adventofcode\Day6\View\day\SixChallengeTwo\Utils;

use Adventofcode\Day6\View\day\SixChallengeTwo\Enum\Direction;

class Game
{
    private Player $player;

    public function __construct(
        public array $grid,
    )
    {
        $this->player = new Player(0, 0, Direction::UP);
        $this->makeNewGrid();
    }

    private function makeNewGrid(): void
    {
        for ($y = 0; $y < count($this->grid); $y++) {
            for ($x = 0; $x < count($this->grid[$y]); $x++) {
                if ($this->grid[$y][$x] === '#') {
                    // Initialize obstacle grid cell
                    $this->grid[$y][$x] = new Grid($x, $y, true);
                } elseif ($this->grid[$y][$x] === '^') {
                    // Initialize player at the first position with a direction
                    $this->player = new Player($x, $y, Direction::UP);
                    $this->grid[$y][$x] = new Grid($x, $y, visaed: true);
                } else {
                    // Initialize empty grid cell
                    $this->grid[$y][$x] = new Grid($x, $y);
                }
            }
        }
    }

    public function setObstacle($x, $y): void
    {
        if (isset($this->grid[$y][$x]) && is_a($this->grid[$y][$x], Grid::class)) {
            $this->grid[$y][$x]->obstacle = true;
        }
    }

    /**
     * Run the game loop until the player can no longer move.
     */
    public function run()
    {
        while (true) {
            $y = $this->player->y;
            $x = $this->player->x;

            if ($this->playerOutOfBounds($x, $y)) {
                print_r("Player is out of bounds at (x: $x, y: $y). Game Over!\n");
                break;
            }

            if ($this->nextPlayerCanMove()) {
                // Mark the current position as visited
                if (is_a($this->grid[$y][$x], Grid::class)) {
                    $this->grid[$y][$x]->visaed = true;
                }

                // Move the player in the current direction
                $this->player->move($this->player->direction);
            } else {
                // Change direction if the player cannot move
                $this->player->nextDirection();
            }

            $currentGrid = $this->grid[$this->player->y][$this->player->x] ?? null;
            if ($currentGrid) {
                $currentGrid->visaed = true; // Mark the current grid as visited
            } else {
                print_r("Current grid is null at ($x, $y). Game Over!\n");
                break;
            }
        }
    }

    public function drawGame(): void
    {
        foreach ($this->grid as $row) {
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
    }


    private function playerOutOfBounds(int $x, int $y): bool
    {
        return $x <= 0 || $x >= count($this->grid[0]) - 1 || $y <= 0 || $y >= count($this->grid) - 1;
    }

    /**
     * Check if the next position the player is trying to move to is valid (not an obstacle and within bounds).
     * @return bool
     */
    private function nextPlayerCanMove(): bool
    {
        $nextX = $this->player->x;
        $nextY = $this->player->y;


        switch ($this->player->direction) {
            case Direction::UP:
                $nextY--;
                break;
            case Direction::DOWN:
                $nextY++;
                break;
            case Direction::LEFT:
                $nextX--;
                break;
            case Direction::RIGHT:
                $nextX++;
                break;
        }


        // Check if the next position is out of bounds
        if ($nextX < 0 || $nextX >= count($this->grid[0]) || $nextY < 0 || $nextY >= count($this->grid)) {
            if ($nextX <= 0 || $nextX >= count($this->grid[0]) || $nextY <= 0 || $nextY >= count($this->grid)) {
                return false; // Out of bounds
            }
        }

        // Check if the next position is an obstacle
        return is_a($this->grid[$nextY][$nextX], Grid::class) && $this->grid[$nextY][$nextX]->obstacle;
    }
}
