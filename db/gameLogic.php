<?php

include_once 'puzzle.php';

class GameLogic {

    const MIN = 1;
    const MAX = 10;

    private static $ALPHA = array(1 => "a", 2 => "b", 3 => "c", 4 => "d", 5 => "e", 6 => "f", 7 => "g",
        8 => "h", 9 => "i", 10 => "j", 11 => "k", 12 => "l", 13 => "m", 14 => "n",
        15 => "o", 16 => "p", 17 => "q", 18 => "r", 19 => "s", 20 => "t", 21 => "u",
        22 => "v", 23 => "w", 24 => "x", 25 => "y", 26 => "z");
    private static $NUMBER = array("a" => 1, "b" => 2, "c" => 3, "d" => 4, "e" => 5, "f" => 6, "g" => 7,
        "h" => 8, "i" => 9, "j" => 10, "k" => 11, "l" => 12, "m" => 13, "n" => 14,
        "o" => 15, "p" => 16, "q" => 17, "r" => 18, "s" => 19, "t" => 20, "u" => 21,
        "v" => 22, "w" => 23, "x" => 24, "y" => 25, "z" => 26);
    private static $OPERATORS = array(1 => "+", 2 => "-", 3 => "*", 4 => "/");

    /**
     * 1. Convert quote to string of numbers
     * 2. Perform a mathematic operation on the string of numbers
     */
    public static function convertQuote2Number($quote) {

        $string = "";
        for ($index = 0; $index < strlen($quote); $index++) {
            if ($quote[$index] != " ") {
                $temp = self::encode(self::$NUMBER[$quote[$index]]);
                $string = $string . $temp . "*";
            }
            if ($quote[$index] == " ") {
                $string = $string . "&";
            }
        }

        return $string;
    }

    /**
     * Parse the string of numbers and encode it back to a string of letters 
     * separated by a space for each word
     */
    public static function convertNumber2String($numbers) {
        $index = 0;
        $encoded = "";
        $numbers = trim($numbers);
        $size = strlen($numbers);
        While ($index < $size) {
            $num = "";
            while ($numbers[$index] != "*") {
                $num = $num . $numbers[$index];
                $index++;
            }
            $index++; // skip *
            if ($index >= $size) {
                break;
            }
            $encoded = $encoded . self::$ALPHA[$num];
            if ($numbers[$index] == "&") {
                $encoded = $encoded . " ";
                $index++; // skip &
            }
        }

        return $encoded;
    }

    public static function encode($number) {
        $a = 2;
        $opt = self::$OPERATORS[1];
        if ($opt == "+") {
            return $number + $a;
        } else {
            return '';
        }
    }

    public static function replaceWithWhiteSpace($numbers) {
        $string = str_replace("*", " ", $numbers);
        $string = str_replace("&", " ", $string);
        return $string;
    }

    public static function getSeed() {
        return rand(self::MIN, self::MAX);
    }

}

?>
