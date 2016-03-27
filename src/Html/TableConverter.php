<?php
/*
 * This file is part of Kugi package.
 */
namespace Kugi\Html;

/**
 * Utility class for convert table from array or object.
 */
class TableConverter
{
    /**
     * TableConverter Options
     * xxxxClass attr class for tag
     * refine to columns array
     */
    private static $options_list = array(
            'tableClass' => '',
            'theadClass' => '',
            'tbodyClass' => '',
            'refine' => false,
        );

    /**
     * init option array.
     *
     * @param  array $options
     * @return array
     */
    private function init ( $options = array() ) {
        if ( empty( $options ) ) {
            return array();
        }

        foreach ( self::$options_list as $key => $value ) {
            if ( isset( $options[$key] ) && !empty( $options[$key] ) ) continue;
            $options[$key] = $value;
        }

        return $options;
    }

    /**
     * convert table tag.
     *
     * @param  array $target
     * @param  array $headers
     * @param  array $options
     * @return string
     */
    public static function convert ( $target = null, $headers = array(), $options = array() )
    {
        $options = self::init( $options );

        if ( empty( $target ) ) {
            return null;
        }

        if ( empty( $headers ) || !is_array( $headers ) ) {
            $headers = array();
        }

        if ( is_array( $target ) ) {
            return self::convertFromArray( $target, $headers, $options );
        }
    }

    /**
     * create table string from arrays.
     *
     * @param  array $target  Value for create table
     * @param  array $headers
     * @param  array $options
     * @return string
     */
    private function convertFromArray ( array $target, array $headers, array $options )
    {
        // table
        $table = self::getTagWithClass( $options, 'table' );
        // thead
        $table .= self::convertHeaders( $target[0], $headers, $options );
        // tbody
        $table .= self::getTagWithClass( $options, 'tbody' );
        foreach ( $target as $row ) {
            $table .= '<tr>';
            foreach ( $row as $key => $col ) {
                // td
                $table .= self::createTd($key, $col, $options);
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
        return $table;
    }

    /**
     * create td string for cell.
     *
     * @param  string $key
     * @param  string $col
     * @param  array  $options
     * @return string
     */
    private function createTd ( $key, $col, array $options )
    {
        if ( !empty( $options['refine'] ) && is_array( $options['refine'] ) ) {
            $refineFlg = false;
            foreach ($options['refine'] as $k) {
                if ($k === $key) $refineFlg = true;
            }
            if ( !$refineFlg ) return '';
        }
        return "<td>{$col}</td>";
    }

    /**
     * create thead string.
     *
     * @param  mixed $first   Value that Object or Array for rows.
     * @param  array $headers
     * @param  array $options
     * @return string
     */
    private function convertHeaders ( $first, &$headers, array $options )
    {
        //
        if ( !is_array( $headers ) || empty( $headers ) ) {
            if ( is_array( $first ) ) {
                $headers = array_keys( $first );
            }
            if ( is_object( $first ) ) {
                $headers = array();
                foreach ($first as $key => $value) {
                    $headers[] = $key;
                }
            }
            // refine
            if ( !empty( $options['refine'] ) && is_array( $options['refine'] ) ) {
                foreach ($headers as $k => $v) {
                    $refineFlg = false;
                    foreach ($options['refine'] as $value) {
                        if ( $v === $value ) {
                            $refineFlg = true;
                            break;
                        }
                    }
                    if ( !$refineFlg ) {
                        unset( $headers[$k] );
                    }
                }
            }
        }

        $thead = self::getTagWithClass( $options, 'thead' );
        $thead .= '<tr>';
        foreach ( $headers as $value ) {
            $thead .= "<th>{$value}</th>";
        }
        $thead .= '</tr></thead>';

        return $thead;
    }

    /**
     * create start tag with class attr.
     *
     * @param  array  $options
     * @param  string $tag
     * @return string
     */
    private function getTagWithClass ( $options, $tag )
    {
        $class = empty( $options[$tag. 'Class'] ) ? '' : ' class="'. $options[$tag. 'Class']. '"';
        return "<{$tag}{$class}>";
    }
}