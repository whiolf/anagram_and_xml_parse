<?php
/**
 * Maintainer Alexey Goncharenko <alexey.sentishev@gmail.com>
 */

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/xml_to_csv.php";

use PHPUnit\Framework\TestCase;

class XmlToCsvTest extends TestCase
{
    public function data_provider_xmlToCSV()
    {
        return [
            'USUAL_XML' => [
                'text' => file_get_contents('data_for_testing/usual.xml'),
                'expected' => file_get_contents('data_for_testing/usual.csv'),
            ],
            'MISSED_FIELDS' => [
                'text' => file_get_contents('data_for_testing/missed_fields.xml'),
                'expected' => file_get_contents('data_for_testing/missed_fields.csv'),
            ],
            'EMPTY_FIELDS' => [
                'text' => file_get_contents('data_for_testing/empty_fields.xml'),
                'expected' => file_get_contents('data_for_testing/empty_fields.csv'),
            ],
            'MANY_TOURS' => [
                'text' => file_get_contents('data_for_testing/many_tours.xml'),
                'expected' => file_get_contents('data_for_testing/many_tours.csv'),
            ],
            'NO_TOURS' => [
                'text' => file_get_contents('data_for_testing/no_tours.xml'),
                'expected' => file_get_contents('data_for_testing/no_tours.csv'),
            ],
            'UNICODE_STRINGS' => [
                'text' => file_get_contents('data_for_testing/unicode.xml'),
                'expected' => file_get_contents('data_for_testing/unicode.csv'),
            ],
            'NO_PRICES' => [
                'text' => file_get_contents('data_for_testing/no_prices.xml'),
                'expected' => file_get_contents('data_for_testing/no_prices.csv'),
            ],
            'NO_DISCOUNT_IN_PRICES' => [
                'text' => file_get_contents('data_for_testing/no_discount_in_prices.xml'),
                'expected' => file_get_contents('data_for_testing/no_discount_in_prices.csv'),
            ],
            'NO_PRICES_IN_EUR' => [
                'text' => file_get_contents('data_for_testing/no_prices_in_eur.xml'),
                'expected' => file_get_contents('data_for_testing/no_prices_in_eur.csv'),
            ],
            'NEGATIVE_PRICES' => [
                'text' => file_get_contents('data_for_testing/negative_prices.xml'),
                'expected' => file_get_contents('data_for_testing/negative_prices.csv'),
            ],
            'INCORRECT_DISCOUNT' => [
                'text' => file_get_contents('data_for_testing/incorrect_discount.xml'),
                'expected' => file_get_contents('data_for_testing/incorrect_discount.csv'),
            ],
            'WITH_PIPES_IN_STRINGS' => [
                'text' => file_get_contents('data_for_testing/with_pipes_in_strings.xml'),
                'expected' => file_get_contents('data_for_testing/with_pipes_in_strings.csv'),
            ],
            'WITH_NEW_LINES' => [
                'text' => file_get_contents('data_for_testing/with_new_lines.xml'),
                'expected' => file_get_contents('data_for_testing/with_new_lines.csv'),
            ],
        ];
    }

    /**
     * @dataProvider data_provider_xmlToCSV
     * @param $text
     * @param $expected
     */
    function test_xmlToCSV($text, $expected)
    {
        $result = xmlToCSV($text);
        $this->assertEquals($expected, $result);
    }
}