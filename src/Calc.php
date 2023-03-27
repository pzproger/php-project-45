<?php

namespace BrainGames\Calc;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\greeting;
use function BrainGames\Even\generateNumber;

function startGame(): void
{
    $name = greeting();

    line('What is the result of the expression?');

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

function getSymbol(): string
{
    $arSymbol = ['+', '-', '*'];

    return $arSymbol[rand(0, count($arSymbol) - 1)];
}

function getExpresion(): array
{
    $number1 = generateNumber();
    $number2 = generateNumber();
    $symbol = getSymbol();
    $exString = "{$number1} {$symbol} {$number2}";

    $exResult = 0;
    switch ($symbol) {
        case '+':
            $exResult = $number1 + $number2;

            break;
        case '-':
            $exResult = $number1 - $number2;

            break;
        case '*':
            $exResult = $number1 * $number2;

            break;
    }

    return [
        'exString' => $exString,
        'exResult' => $exResult,
    ];
}
