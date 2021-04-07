<?php


namespace App;


use Exception;

class StringCalculator
{
    private string $delimiterRegex = "[,\n]";

    const CUSTOM_DELIMITER_REGEX = '\/\/(.)\n';
    const MAX_NUMBER = 1000;

    /**
     * @param string $input
     * @return int
     * @throws Exception
     */
    public function add(string $input): int
    {
        if(empty($input)){
            throw new Exception("No input provided");
        }

        return array_reduce($this->parseInput($input), "self::addNumbers", 0);
    }

    /**
     * @param int $sum
     * @param int $number
     * @return int
     * @throws Exception
     */
    public static function addNumbers(int $sum, int $number): int {
        self::disallowNegativeNumbers($number);

        if($number > self::MAX_NUMBER){
            return $sum;
        }

        return $sum + $number;
    }

    /**
     * @param int $number
     * @throws Exception
     */
    public static function disallowNegativeNumbers(int $number): void
    {
        if ($number < 0) {
            throw new Exception("Numbers may not be smaller than 0");
        }
    }

    /**
     * @param string $input
     * @return int[]
     */
    public function parseInput(string $input): array
    {
        if (preg_match("/" . self::CUSTOM_DELIMITER_REGEX . "/", $input, $matches)) {
            $this->delimiterRegex = $matches[1];

            $input = str_replace($matches[0], '', $input);
        }

        return preg_split("/{$this->delimiterRegex}/", $input);
    }
}