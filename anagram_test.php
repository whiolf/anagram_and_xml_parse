<?php
/**
 * Maintainer Alexey Goncharenko <alexey.sentishev@gmail.com>
 */

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/anagram.php";

use PHPUnit\Framework\TestCase;

class AnagramTest extends TestCase
{
    public function data_provider_anagram()
    {
        return [
            'CORRECT_ANAGRAMS' => [
                'string1' => 'married',
                'string2' => 'admirer',
                'expected_result' => true,
            ],
            'CORRECT_ANAGRAMS_EQUAL_STRINGS' => [
                'string1' => 'qwerty',
                'string2' => 'qwerty',
                'expected_result' => true,
            ],
            'CORRECT_ANAGRAMS_WITH_UPPER_CASE' => [
                'string1' => 'MARRIED',
                'string2' => 'admirer',
                'expected_result' => true,
            ],
            'CORRECT_ANAGRAMS_WITH_SPACES' => [
                'string1' => 'AstroNomers',
                'string2' => 'no more stars',
                'expected_result' => true,
            ],
            'CORRECT_ANAGRAMS_UNICODE_STRINGS' => [
                'string1' => 'Аз есмь строка живу я мерой остр',
                'string2' => 'За семь морей ростка я вижу рост',
                'expected_result' => true,
            ],
            'IGNORING_PUNCTUATION' => [
                'string1' => 'Tom, Marvolo!! Riddle.',
                'string2' => 'I am Lord! Voldemort?!',
                'expected_result' => true,
            ],
            'DUPLICATED_LETTERS' => [
                'string1' => 'marriedd',
                'string2' => 'admirer',
                'expected_result' => false,
            ],
            'DIFFERENT_STRINGS' => [
                'string1' => 'test test',
                'string2' => 'admirer',
                'expected_result' => false,
            ],
            'INVALID_INPUT_EMPTY_1ST_STRING' => [
                'string1' => '',
                'string2' => 'admirer',
                'expected_result' => false,
            ],
            'INVALID_INPUT_EMPTY_2ND_STRING' => [
                'string1' => 'admirer',
                'string2' => '',
                'expected_result' => false,
            ],
            'INVALID_INPUT_STRINGS_CONTAIN_DIGITS' => [
                'string1' => '1 admirer',
                'string2' => 'admirer 1',
                'expected_result' => false,
            ],
            'INVALID_INPUT_EMPTY_BOTH_STRING' => [
                'string1' => '',
                'string2' => '',
                'expected_result' => false,
            ],
            'INVALID_INPUT_NOT_A_STRING' => [
                'string1' => 1234,
                'string2' => 'married',
                'expected_result' => false,
            ],
            'INVALID_INPUT_NOT_A_2ND_STRING' => [
                'string1' => 'married',
                'string2' => 12121,
                'expected_result' => false,
            ],

            'INCORRECT_ANAGRAMS_UNICODE_STRINGS' => [
                'string1' => 'Аз есмь строка живу я мерой остр',
                'string2' => 'Другой какой-то текст',
                'expected_result' => false,
            ],
        ];
    }

    /**
     * @dataProvider data_provider_anagram
     *
     * @param string $string1
     * @param string $string2
     * @param $expected_result
     */
    public function test_anagram($string1, $string2, $expected_result)
    {
        $real_result = anagram($string1, $string2);

        $this->assertEquals($expected_result, $real_result);
    }
}