<?php namespace App\Helpers;

use Carbon\Carbon;
use Config;

/**
 * Most usable set of operations and so on...
 *
 * @author Sergey Donchenko, <sergey.donchenko@gmail.com>
 */
class File {

    /**
     * Generate the file name
     *
     * @return String
     */
    public static function generateName()
    {
        return md5(microtime());
    }

    /**
     * Returns public path
     *
     * @return String
     */
    public static function getPublicPath()
    {
        return Config::get('content.storage');
    }

    /**
     * Returns a Storage path
     *
     * @return String
     */
    public static function getStoragePath()
    {
        return public_path() . self::getPublicPath();
    }

    /**
     * Returns the path to the file based on date
     * for example 2016/03/23/somefile_here.txt
     *
     * @param mixed $date
     *
     * @return String
     */
    public static function getPathByDate( $date = NULL)
    {
        if ( empty($date) ) {
            $oDate = Carbon::now();
        }else{
            $oDate = Carbon::parse($date);
        }

        return $oDate->year
            . DIRECTORY_SEPARATOR . $oDate->month
            . DIRECTORY_SEPARATOR . $oDate->day
            . DIRECTORY_SEPARATOR;
    }


    /**
     * Returns folder name where we should store the content
     *
     * @param Carbon\Carbon $date - date
     *
     * @return String
     */
    public static function getDestinationFolder($date = null)
    {
        return  self::getStoragePath()
            . DIRECTORY_SEPARATOR . self::getPathByDate($date);
    }

    /**
    * Returns browser oriented path
    */
    public static function getURL( $sPath )
    {
        return url( self::getPublicPath() . DIRECTORY_SEPARATOR . $sPath);
    }

    /**
     * Return specific path for the Image
     * 
     * @param  string $sPath Path like 2015/12/5/%sasdasdasdasdasdasdkaslkdlaskdlasld.jpeg
     * @param  string $sBox  box type, for example box1
     * 
     * @return string        full path for the Image
     */
    public static function getImagePathURL($sPath, $sBox = '')
    {
        $sBox = empty($sBox) ? '' : $sBox . DIRECTORY_SEPARATOR;

        return sprintf(self::getURL($sPath), $sBox);
    }


    /**
     * Check if file is image
     *
     * @param String $sMimeType - mime type
     *
     * @return Bollean
     */
    public static function isImage($sMimeType)
    {
        return (substr($sMimeType, 0, 5) === 'image');
    }

    /**
     * Returns the collections of thumbnails
     *
     * @param String $sType - type of the content
     * @param Boolean $isImage - handled file is image
     *
     * @return Array a list of objects
     */
    public static function getThumbnailSizes( $sType = null, $isImage = false )
    {
        $aResources   = Config::get('constants.RESOURCES');
        $sType        = empty($sType) ? $aResources['PHOTO_GALLERY'] : $sType;
        $aCollections = array();

        if ( $isImage === false ) {
            return $aCollections;
        }

        if ( $sType === $aResources['NEWS'] ) {
            $aCollections[] = (object) array('ident' => 'box2', 'height' => '70', 'width'=> '120');
            $aCollections[] = (object) array('ident' => 'box3', 'height' => '140', 'width'=> '220');
            $aCollections[] = (object) array('ident' => '140x100', 'height' => '100', 'width'=> '140');
            $aCollections[] = (object) array('ident' => '140x_', 'height' => '0', 'width'=> '140');
            $aCollections[] = (object) array('ident' => '200x_', 'height' => '0', 'width'=> '200');
            $aCollections[] = (object) array('ident' => '455x_', 'height' => '0', 'width'=> '455');
        } else if ( $sType === $aResources['ANNOUNCE'] ) {
            $aCollections[] = (object) array('ident' => 'box2', 'height' => '70', 'width'=> '120');
            $aCollections[] = (object) array('ident' => 'box3', 'height' => '140', 'width'=> '220');
            $aCollections[] = (object) array('ident' => '140x_', 'height' => '0', 'width'=> '140');
            $aCollections[] = (object) array('ident' => '200x_', 'height' => '0', 'width'=> '200');
            $aCollections[] = (object) array('ident' => '650x330', 'height' => '330', 'width'=> '650');
            $aCollections[] = (object) array('ident' => '455x_', 'height' => '0', 'width'=> '455');
        } else if ( $sType === $aResources['PHOTO_GALLERY'] || $isImage === true ) {
            $aCollections[] = (object) array('ident' => 'box1', 'height' => '50', 'width'=> '50');
            $aCollections[] = (object) array('ident' => 'box2', 'height' => '100', 'width'=> '100');
            $aCollections[] = (object) array('ident' => 'box3', 'height' => '200', 'width'=> '200');
            $aCollections[] = (object) array('ident' => 'box4', 'height' => '170', 'width'=> '260');
        }

        return $aCollections;
    }
}
