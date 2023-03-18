<?php

namespace BrainGames\Progression;

use function cli\line;
use function cli\prompt;

class GameProgression
{
    public function __construct()
    {
        self::startGame();
    }

    private function greeting(): string
    {
        line('Welcome to the Brain Games!');
        $name = prompt('May I have your name?');

        line("Hello, %s!", $name);

        return $name;
    }

    private function generateNumber(int $maxNum = 99): int
    {
        return rand(1, $maxNum);
    }

    private function startGame()
    {
        $name = self::greeting();

        line('What number is missing in the progression?');

        for ($i = 1; $i < 4; $i++) {
            $exData = self::getExpresion();
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

    private function getExpresion(): array
    {
        $beginProgression = self::generateNumber();
        $stepProgression = self::generateNumber(10);

        $arProgression[] =  $beginProgression;
        $i = 0;
        while ($i < 9) {
            $arProgression[] =  $arProgression[count($arProgression) - 1] + $stepProgression;
            $i++;
        }

        $hiddenNumber = $arProgression[array_rand($arProgression)];
        $arProgression[array_search($hiddenNumber, $arProgression, true)] = '..';
        $exString = implode(' ', $arProgression);
        $exResult = $hiddenNumber;

        return [
            'exString' => $exString,
            'exResult' => $exResult,
        ];
    }
}
