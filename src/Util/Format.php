<?php
/*
 * This file is part of Kugi package.
 */
namespace Kugi\Util;

/**
 * Utility class for string format.
 *
 * @version 0.0.1 madamada...
 */
class Format
{
    private function __construct(){

    }

    /**
     * change to wareki year.[平成・昭和・大正]
     *
     * @param string $year before change year
     * @return string wareki year
     */
    public static function way($year, $format = '%s%d年')
    {
        if ( strlen($year) !== 4 || empty($year) ) return $year;

        if ($year >= 1989) {
            $g = "平成";
            $year = $year - 1988;
        } elseif ($year >= 1926) {
            $g = "昭和";
            $year = $year - 1925;
        } elseif ($year >= 1912) {
            $g = "大正";
            $year = $year - 1911;
        } else {
            $g = '';
        }

        return sprintf($format, $g, $year);
    }

    /**
     * price format
     *
     * @param  integer $price numeric price
     * @param  string $mark  prefix
     * @return string        formatted price
     */
    public static function pf($price, $mark = '&yen;')
    {
        if (is_float($price)) {
            $sp = sprintf('%f', $price);
            $sp = preg_replace("/\.?0+$/", "", $sp);
        } else {
            $sp = (string)$price;
        }

        if ( !is_numeric($price) ) return $price;

        if ( empty($mark) ) {
            $mark = '';
        }

        if (strpos($sp, '.') !== false) {
            return $mark. number_format( $sp, strlen($sp) - strpos($sp, '.') - 1, '.', ',' );
        } else {
            return $mark. number_format( $price, 0, '.', ',' );
        }
    }

    /**
     * 文字列を丸める
     * @param  string  $string
     * @param  integer $start
     * @param  integer $end
     * @param  string  $endstring
     * @return string
     */
    public static function strim($string, $start = 0, $end = 80, $endstring = '...')
    {
        return mb_strimwidth($string, $start, $end, $endstring, 'UTF-8');
    }
}