<?php

namespace App\Listeners\Files;

use App\Events\Files\FileWasLoaded;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Helpers\File as cFile;
use Carbon\Carbon;
use Config;
use Image;
use App\Repositories\FileRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoadFileListener
{
    /**
     * Injected variable
     *
     * @var Object (Illuminate\Filesystem\Filesystem)
    */
    protected $files = null;

    /**
     * File repository
     *
     * @var Object (App\Repositories\FileRepository)
    */
    protected $storage = null;

    /**
     * Create the event listener.
     *
     * @param Filesystem $file - injected variable
     *
     */
    public function __construct(Filesystem $file, FileRepository $storage)
    {
        // Injsct the filesystem instance
        $this->files = $file;

        // Inject the file storage instance
        $this->storage = $storage;
    }

    /**
     * Handle the event.
     *
     * @param  FileWasLoaded  $event
     * @return void
     */
    public function handle(FileWasLoaded $event)
    {
        $aParams = $event->aParams;

        $file    = array_key_exists('file', $aParams) ? $aParams['file'] : null;
        $type    = array_key_exists('type', $aParams) ? $aParams['type'] : '---';
        $id      = array_key_exists('id', $aParams) ? $aParams['id'] : null;
        $prefix	 = array_key_exists('prefix', $aParams) ? $aParams['prefix'] : '';
        $date 	 = array_key_exists('date', $aParams) ? $aParams['date'] : Carbon::now();

        $sFolder     = cFile::getDestinationFolder($date) . $type;
        $sResultFile = '';
        $iReturnCode = Config::get('constants.DONE_STATUS.FAILURE');

        if ( $file instanceof UploadedFile) {
            $sFileName = cFile::generateName() . '.';

            if ( $this->files->exists($sFolder) === false ) {
                $this->files->makeDirectory($sFolder, $mode = 0777, true, true);
            }

            $sFileName    .= $file->guessExtension();
            $sMimeType     = $file->getMimeType();
            $iFileSize     = $file->getSize();
            $sOrigFileName = $file->getClientOriginalName();

            // Path where we are going to move to this file
            $sPath = sprintf(
                cFile::getPathByDate($date) .
                $type . DIRECTORY_SEPARATOR . '%s', $sFileName
            );

            // Result path
            $sResultFile = sprintf(
                cFile::getPathByDate($date) .
                $type . DIRECTORY_SEPARATOR . '%s', $prefix . $sFileName
            );

            if ( $file->move($sFolder, $sFileName) ) {

                $iFileId = $this->storage->store([
                    'path' => $sPath,
                    'file_type' => $sMimeType,
                    'file_name' => $sOrigFileName,
                    'file_size' => $iFileSize,
                    'content_id' => $id,
                    'content_type' => $type
                ]);

                if ( $iFileId ) {
                    $aThumbnails = cFile::getThumbnailSizes( $type, cFile::isImage($sMimeType) );
                    $sStoragePath = cFile::getStoragePath();

                    foreach($aThumbnails as $oThumb) {

                        $sXFolderPath 	  = sprintf(
                            cFile::getPathByDate($date) .
                            $type . DIRECTORY_SEPARATOR . '%s', $oThumb->ident
                        );

                        $sXFolderFullPath = $sStoragePath . DIRECTORY_SEPARATOR . $sXFolderPath;
                        $sResizedFileName = sprintf($sXFolderPath . DIRECTORY_SEPARATOR . '%s', $sFileName);

                        if ( $this->files->exists($sXFolderFullPath) === false ) {
                            $this->files->makeDirectory($sXFolderFullPath, $mode = 0777, true, true);
                        }

                        if ( $this->files->exists( $sStoragePath . DIRECTORY_SEPARATOR . $sPath ) ) {
                            Image::make($sStoragePath . DIRECTORY_SEPARATOR . $sPath)
//                                ->insert( cFile::applyWatermark(), 'bottom-right', 10, 10 )
                                ->resize($oThumb->width, $oThumb->height)
                                ->save(sprintf($sXFolderFullPath . DIRECTORY_SEPARATOR . '%s', $sFileName));

                            $this->storage->store([
                                'path' => $sResizedFileName,
                                'file_type' => $sMimeType,
                                'file_name' => $sOrigFileName,
                                'file_size' => $iFileSize,
                                'content_id' => $id,
                                'content_type' => $type
                            ]);
                        }
                    }
                    $iReturnCode = Config::get('constants.DONE_STATUS.SUCCESS');
                }
            }
        }

        $object = json_decode(json_encode(array(
            'code' => $iReturnCode,
            'filepath' => $sResultFile
        )), FALSE);

        return $object;
    }
}
