<?php

/**
 * Based on http://wiki.vg/Chat
 */
class MinecraftJsonColors {

    const COLOR_CHAR = "§";

    static private $colors = array(
        'black' => '0',
        'dark_blue' => '1',
        'dark_green' => '2',
        'dark_aqua' => '3',
        'dark_red' => '4',
        'dark_purple' => '5',
        'gold' => '6',
        'gray' => '7',
        'dark_gray' => '8',
        'blue' => '9',
        'green' => 'a',
        'aqua' => 'b',
        'red' => 'c',
        'light_purple' => 'd',
        'yellow' => 'e',
        'white' => 'f',
    );
    static private $formatting = array(
        'obfuscated' => 'k',
        'bold' => 'l',
        'strikethrough' => 'm',
        'underline' => 'n',
        'italic' => 'o',
        'reset' => 'r'
    );

    public static function convertToLegacy($json) {
        $legacy = '';
        if (isset($json['extra'])) {
            foreach ($json['extra'] as $component) {
                if (is_string($component)) {
                    $legacy .= $component;
                } else {
                    //reset the formatting to make the components independent
                    $legacy .= self::parseElement($component) . self::COLOR_CHAR . self::$formatting['reset'];
                }
            }
        }

        $legacy .= self::parseElement($json);
        return $legacy;
    }

    private static function parseElement($json) {
        $legacy = '';
        if (isset($json['obfuscated'])) {
            if ($json['obfuscated']) {
                $legacy .= self::COLOR_CHAR . self::$formatting['obfuscated'];
            }
        }

        if (isset($json['strikethrough'])) {
            if ($json['strikethrough']) {
                $legacy .= self::COLOR_CHAR . self::$formatting['strikethrough'];
            }
        }

        if (isset($json['underlined'])) {
            if ($json['underlined']) {
                $legacy .= self::COLOR_CHAR . self::$formatting['underlined'];
            }
        }

        if (isset($json['italic'])) {
            if ($json['italic']) {
                $legacy .= self::COLOR_CHAR . self::$formatting['italic'];
            }
        }

        if (isset($json['bold'])) {
            if ($json['bold']) {
                $legacy .= self::COLOR_CHAR . self::$formatting['bold'];
            }
        }

        if (isset($json['color'])) {
            $color = $json['color'];
            if (isset(self::$colors[$color])) {
                $legacy .= self::COLOR_CHAR . self::$colors[$color];
            }
        }

        if (isset($json['text'])) {
            $legacy .= $json['text'];
        }

        return $legacy;
    }
}
