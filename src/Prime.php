<?php

namespace BrainGames\Prime;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\greeting;
use function BrainGames\Even\generateNumber;

function startGame(): void
{
    $name = greeting();

    line('Answer "yes" if given number is prime. Otherwise answer "no".');

    for ($i = 1; $i < 4; $i++) {
        $exData = getExpresion();
        line('Question: ' . $exData['exString']);

        $answer = prompt('Your answer');

        if (
            $answer == $exData['exResult']
        ) {
            $i == 3 ? line("Congratulations, {$name}!") : line("Correct!");
        } else {
            line("{$answer} is wrong answer ;(. Correct answer was {$exData['exResult']}.");
            line("Let's try again, {$name}!");
            break;
        }
    }
}

function getExpresion(): array
{
    $number = generateNumber();

    $isPrime = true;

    if ($number > 1) {
        for ($i = $number - 1; $i > 1; $i--) {
            if ($number % $i == 0) {
                $isPrime = false;
            }
        }
    }

    $exResult = $isPrime ? 'yes' : 'no';
    $exString = $number;

    return [
        'exString' => $exString,
        'exResult' => $exResult,
    ];
}
