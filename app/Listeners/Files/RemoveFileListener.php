<?php

namespace App\Listeners\Files;

use App\Events\Files\FileWasRemoved;
use Illuminate\Filesystem\Filesystem;
use App\Repositories\FileRepository;
use Config;
use App\Helpers\File as cFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveFileListener
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
     * @return void
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
     * @param  FileWasRemoved  $event
     * @return void
     */
    public function handle(FileWasRemoved $event)
    {
        $aParams = $event->aParams;

        $path    = array_key_exists('path', $aParams) ? $aParams['path'] : null;
        $type    = array_key_exists('type', $aParams) ? $aParams['type'] : '---';
        $id      = array_key_exists('id', $aParams) ? $aParams['id'] : null;

        $iReturnCode = Config::get('constants.DONE_STATUS.FAILURE');
        $iTotal      = 0;
        $aFiles      = [];

        $sStoragePath = cFile::getStoragePath();

        if ( $path ) {
            $aFiles = $this->storage->getByPath( [
                'path' => $path
            ] );
        }

        if ( $aFiles ) {
            foreach( $aFiles as $item ) {
                if ( $this->files->delete( $sStoragePath . DIRECTORY_SEPARATOR . $item['path'] ) === true ) {
                    $iTotal = $iTotal + $this->storage->destroy( $item['id'] );
                }
            }
        }

        return (object) array(
            'code' => $iReturnCode,
            'total' => $iTotal
        );

    }
}
