<?php
/*
 * This file is part of Kugi package.
 */
namespace Kugi\Util;

/**
 * Utility class for WordPress.
 *
 * @version 0.0.1 madamada...
 */
class WP
{
    private function __construct(){

    }

    /**
     * js,cssのscriptタグおよびlinkタグ文字列生成
     *
     * @param  string $root      テーマディレクトリパス
     * @param  array $fileNames  js,cssファイル名配列 array('xxx.js', 'xxx.css')
     * @param  array $options
     * @return string            生成した文字列(<link> and <script>)
     */
    public static function returnJsCssSources( $root, $fileNames, $options = null )
    {
        $result = "";

        $css_rel  = "stylesheet";
        $css_type = "text/css";
        $js_type  = "text/javascript";

        $css_directory = '/css/';
        $js_directory  = '/js/';

        if (is_array($options) && count($options) > 0) {
            if (array_key_exists('css_directory', $options)) {
                $css_directory = $options['css_directory'];
            }
            if (array_key_exists('js_directory', $options)) {
                $js_directory = $options['js_directory'];
            }
        }

        if(is_array($fileNames))
        {
            foreach($fileNames as $file)
            {
                if(preg_match("/css$/", $file)){
                    $href = $root. '/css/' . $file;
                    $result .= '<link href="' . $href . '" rel="' . $css_rel . '" type="' . $css_type . '" media="screen" />' . PHP_EOL;
                }

                if(preg_match("/js$/", $file)){
                    $src = $root. '/js/' . $file;
                    $result .= '<script src="' . $src . '" type="' . $js_type . '" />' . PHP_EOL;
                }

            }
        }

        return $result;
    }
}