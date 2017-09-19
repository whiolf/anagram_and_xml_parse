<?php
/**
 * Maintainer Alexey Goncharenko <alexey@webdm.de>
 */


/**
 * Anagrams Detection
 *
 * Unicode strings also supported
 * Сase insensitive
 * Spaces ignored
 * Punctuation ignored and other signs ignored
 *
 * @param $string1
 * @param $string2
 * @return bool if two input strings form anagrams of each other
 */
function anagram($string1, $string2)
{
    if (!is_string($string1) || !is_string($string2)) {
        return false;
    }

    //There isn't a description about strings which include digits in the task
    //So I will mean such strings are incorrect
    if (isStringContainsDigits($string1) || isStringContainsDigits($string2)) {
        return false;
    }

    $string1 = prepareString($string1);
    $string2 = prepareString($string2);

    if (empty($string1) || empty($string2)) {
        return false;
    }

    if ($string1 === $string2) {
        return true;
    }

    if (mb_strlen($string1) != mb_strlen($string2)) {
        return false;
    }

    $string1_arr = str_split_unicode(mb_strtolower($string1));
    $string2_arr = str_split_unicode(mb_strtolower($string2));

    sort($string1_arr);
    sort($string2_arr);

    return $string1_arr == $string2_arr;
}

/**
 * Check is string contains digits
 * @param $string
 * @return bool
 */
function isStringContainsDigits($string)
{
    $pattern = '/\d/';
    preg_match($pattern, $string, $matches);
    if ($matches) {
        return true;
    }

    return false;
}

/**
 * Removing all symbols except [[:word:]]
 * @param $string
 * @return mixed
 */
function prepareString($string)
{
    $pattern = '/[^\w]|_/u';
    return preg_replace($pattern, '', $string);
}

/**
 * Correct splitting Unicode String to Array
 *
 * @param $str
 * @param int $length
 * @return array
 */
function str_split_unicode($str, $length = 1) {
    $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);
    if ($length > 1) {
        $chunks = array_chunk($tmp, $length);
        foreach ($chunks as $i => $chunk) {
            $chunks[$i] = join('', (array) $chunk);
        }
        $tmp = $chunks;
    }
    return $tmp;
}

