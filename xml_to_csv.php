<?php
/**
 * Maintainer Alexey Goncharenko <alexey.sentishev@gmail.com>
 */


/**
 * Converting xml string to csv string
 *
 * Delimiter of items: pipe
 * Delimiter of strings: \n
 *
 * Unicode strings also supported
 *
 *
 * @param $text
 * @return string
 */
function xmlToCSV($text)
{
    $ToursXml = new SimpleXMLElement($text);

    $line = [];
    $line[] = 'Title';
    $line[] = 'Code';
    $line[] = 'Duration';
    $line[] = 'Inclusions';
    $line[] = 'MinPrice';

    $csv = join('|', $line) . PHP_EOL;

    $Tours = $ToursXml->TOUR;

    if (boolval($Tours)) {
        foreach ($Tours as $Tour) {
            $line = [];

            $line[] = prepareString($Tour->Title->__toString());
            $line[] = prepareString($Tour->Code->__toString());
            $line[] = intval($Tour->Duration);
            $line[] = prepareString($Tour->Inclusions->__toString());
            $line[] = getMinDiscountedPrice($Tour->DEP);

            $csv_string = join('|', $line);

            $csv .= $csv_string . PHP_EOL;
        }
    }

    $csv = trim($csv);
    return $csv;
}

/**
 * Calculating min discounted price
 *
 * @param SimpleXMLElement[] $departure_list
 * @return float|int
 */
function getMinDiscountedPrice($departure_list)
{
    $min_price = 0.00;

    foreach ($departure_list as $departure) {
        if (empty($departure['EUR'])) {
            continue;
        }
        $departure_price_eur = floatval($departure['EUR']);

        if ($departure_price_eur <= 0) {
            continue;
        }

        $discount_percent = !empty($departure['DISCOUNT']) ? intval($departure['DISCOUNT']) : 0;

        if ($discount_percent > 100) {
            continue;
        }

        $discount = $discount_percent ? ($departure['EUR'] / 100 * $discount_percent) : 0;

        $real_price = $departure_price_eur - $discount;

        if ($real_price < $min_price || !$min_price) {
            $min_price = $real_price;
        }
    }

    $min_price = number_format($min_price, 2, '.', '');

    return $min_price;
}

/**
 * Prepare string to save it as CSV
 *
 * @param $string
 * @return mixed|string
 */
function prepareString($string)
{
    $string = strip_tags($string);
    $string = html_entity_decode($string);
    $string = str_replace('|', '', $string);
    $string = preg_replace('/\s+/u', ' ', $string);

    // Removing spaces from the start and the end of UNICODE string
    $string = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $string);

    return $string;
}