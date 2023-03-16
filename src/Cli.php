<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

class Hello
{
    public static function greeting(): void
    {
        line('Welcome to the Brain Game!');
        $name = prompt('May I have your name?');

        line("Hello, %s!", $name);
    }
}
