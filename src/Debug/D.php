<?php
/*
 * This file is part of Kugi package.
 */
namespace Kugi\Debug;

/**
 * Utility class for debug.
 *
 * @version 0.0.1 madamada...
 */
class D
{
    private function __construct()
    {

    }

    /**
     * var_dump.
     */
    public static function d()
    {
        $style = 'background:#fff;color:#333;border:1px solid #ccc;margin:2px;padding:4px;font-family:monospace;font-size:12px';
        echo '<pre style="'. $style. '">';
        foreach (func_get_args() as $v) var_dump($v);
        echo '</pre>';
    }
}
