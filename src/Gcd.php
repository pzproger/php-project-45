<?php

namespace BrainGames\Gcd;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\greeting;
use function BrainGames\Even\generateNumber;

function startGame(): void
{
    $name = greeting();

    line('Find the greatest common divisor of given numbers.');

    for ($i = 1; $i < 4; $i++) {
        $exData = getExpresion();
        line('Question: ' . $exData['exString']);

        $answer = prompt('Your answer');

        if (
            $answer == $exData['exResult']
        ) {
            $i == 3 ? line("Congratulations, {$name}!") : line("Correct!");
        } else {
            line("'{$answer}' is wrong answer ;(. Correct answer was '{$exData['exResult']}'.");
            line("Let's try again, {$name}!");
            break;
        }
    }
}

function getExpresion(): array
{
    $number1 = generateNumber();
    $number2 = generateNumber();

    $exString = "{$number1} {$number2}";
    // TODO need extension gmp
//        $exResult = gmp_gcd($number1, $number2);
    // simple algorithm
    $exResult = 1;
    $minNumber = min($number1, $number2);

    for ($i = $minNumber; $i > 1; $i--) {
        if ($number1 % $i === 0 && $number2 % $i === 0) {
            $exResult = $i;
            break;
        }
    }

    return [
        'exString' => $exString,
        'exResult' => $exResult,
    ];
}
