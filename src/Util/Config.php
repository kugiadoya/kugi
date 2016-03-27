<?php
/*
 * This file is part of Kugi package.
 */
namespace Kugi\Util;

/**
 * Utility class for reading config file.
 *
 * @version 0.0.1 madamada...
 */
class Config
{
    private function __construct(){

    }

    /**
     * set const from config file.
     *
     * @param string $path
     */
    public static function set( $path )
    {
        if ($config = parse_ini_file($path, false)){
            foreach ($config as $key => $value){
                if (!defined(strtoupper($key))) {
                    define( strtoupper( $key ), $value );
                }
            }
        }else{
            return;
        }
    }

    /**
     * use defined value if it's find
     *
     * @param  string  $key     config key
     * @param  string  $default used if config key not exits
     * @return string           value
     */
    public static function is($key, $default = null)
    {
        if (defined( $key ) === true) {
            return constant( $key );
        }
        return $default;
    }

}