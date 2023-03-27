<?php

namespace BrainGames\Progression;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\greeting;
use function BrainGames\Even\generateNumber;

function startGame(): void
{
    $name = greeting();

    line('What number is missing in the progression?');

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
    $exString = '';
    $exResult = 0;
    $beginProgression = generateNumber();
    $stepProgression = generateNumber(10);
    $arProgression = [];
    if ($beginProgression > 0) {
        $arProgression[] = $beginProgression;
        $i = 0;
        while ($i < 9) {
            $arProgression[] = $arProgression[count($arProgression) - 1] + $stepProgression;
            $i++;
        }

        $hiddenNumber = $arProgression[array_rand($arProgression)];
        $arProgression[array_search($hiddenNumber, $arProgression, true)] = '..';
        $exString = implode(' ', $arProgression);
        $exResult = $hiddenNumber;
    }

    return [
        'exString' => $exString,
        'exResult' => $exResult,
    ];
}
