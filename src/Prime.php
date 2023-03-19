<?php

namespace BrainGames\Prime;

use function cli\line;
use function cli\prompt;

class GamePrime
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

    private function generateNumber(int $maxNum = 100): int
    {
        return rand(1, $maxNum);
    }

    private function startGame()
    {
        $name = self::greeting();

        line('Answer "yes" if given number is prime. Otherwise answer "no".');

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
        $number = self::generateNumber();

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
}
