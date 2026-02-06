<?php

namespace App\Helpers;

/**
 * String Helper
 * 
 * Utility functions for string manipulation
 */
class StringHelper
{
    /**
     * Remove accents from a string.
     *
     * @param string $string
     * @return string
     */
    public static function removeAccents(string $string): string
    {
        $accents = [
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O',
            'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
            'Ç' => 'C', 'ç' => 'c',
            'Ñ' => 'N', 'ñ' => 'n',
            'Ý' => 'Y', 'ý' => 'y', 'ÿ' => 'y',
        ];

        return strtr($string, $accents);
    }

    /**
     * Normalize string for search (remove accents and convert to lowercase).
     *
     * @param string $string
     * @return string
     */
    public static function normalizeForSearch(string $string): string
    {
        return mb_strtolower(self::removeAccents($string), 'UTF-8');
    }
}
