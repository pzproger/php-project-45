<?php

namespace BrainGames\Gcd;

use function cli\line;
use function cli\prompt;

class GameGcd
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

        line('Find the greatest common divisor of given numbers.');

        for ($i = 1; $i < 4; $i++) {
            $exData = self::getExpresion();
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

    private function getExpresion(): array
    {
        $number1 = self::generateNumber();
        $number2 = self::generateNumber();

        $exString = "{$number1} {$number2}";
        // TODO need extension gmp
//        $exResult = gmp_gcd($number1, $number2);
        // simple algorithm
        $exResult = 1;
        $minNumber = min($number1, $number2);
        
        for ($i = $minNumber - 1; $i > 1; $i--) {
            if ($number1 % $i == 0 && $number2 == 0) {
                $exResult = $i;
                break;
            }
        }

        return [
            'exString' => $exString,
            'exResult' => $exResult,
        ];
    }
}
