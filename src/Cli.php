<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

function welcome(): void
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');

    line("Hello, %s!", $name);
}
//class Hello
//{
//    public static function welcome(): void
//    {
//        line('Welcome to the Brain Game!');
//        $name = prompt('May I have your name?');
//
//        line("Hello, %s!", $name);
//    }
//}

