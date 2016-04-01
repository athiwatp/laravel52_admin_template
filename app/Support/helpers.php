<?php

use App\Helpers\File as cFile;

if (! function_exists('get_file_url') ) {

    /**
     * Возвращает путь картинки.
     *
     * @param  string  $photo 
     * @param  spring  $box
     * @return string
     */
    function get_file_url( $photo, $box )
    {
        return ( $photo ? cFile::getImagePathURL($photo, $box) : '' );
    }
}