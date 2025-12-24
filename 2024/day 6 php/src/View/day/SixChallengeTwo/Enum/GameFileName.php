<?php

declare(strict_types=1);

namespace Adventofcode\Day6\View\day\SixChallengeTwo\Enum;
enum GameFileName: string
{
    case EXAMPLE = 'example.txt';
    case INPUT = 'input.txt';

    public function lebel() : string
    {
        return match ($this) {
            self::EXAMPLE => 'Example.txt',
            self::INPUT => 'Input.txt',
        };
    }
}