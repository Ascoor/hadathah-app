<?php
namespace App\Helpers;

class ConversionHelper {
    public static function convertNameToEnglish($name) {
        $transliterator = \Transliterator::create('Any-Latin; Latin-ASCII');
        return $transliterator->transliterate($name);
    }
}
