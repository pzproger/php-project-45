<?php

namespace BrainGames\Even;

use function cli\line;
use function cli\prompt;

class GameEven
{
    public function gameEven(): void
    {
        line('Welcome to the Brain Games!');
        $name = prompt('May I have your name?');

        line("Hello, %s!", $name);

        line('Answer "yes" if the number is even, otherwise answer "no".');

        for ($i = 1; $i < 4; $i++) {
            $number = self::generateNumber();
            line('Question: ' . $number);

            $answer = prompt('Your answer');

            if (
                $number % 2 === 0 && $answer === 'yes'
                || $number % 2 !== 0 && $answer === 'no'
            ) {
                $i == 3 ? line("Congratulations, {$name}!") : line("Correct!");
            } else {
                line("{$answer} is wrong answer ;(. Correct answer was 'no'.\nLet's try again, {$name}!");
                break;
            }
        }
    }

    private function generateNumber(int $maxNum = 100): int
    {
        return rand(1, $maxNum);
    }
}
