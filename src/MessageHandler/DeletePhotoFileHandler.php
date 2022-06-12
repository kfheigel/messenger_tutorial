<?php

namespace App\MessageHandler;

use App\Photo\PhotoFileManager;
use App\Message\DeletePhotoFile;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeletePhotoFileHandler implements MessageHandlerInterface
{
    protected $photoManager;

    public function __construct(PhotoFileManager $photoManager)
    {
        $this->photoManager = $photoManager;
    }

    public function __invoke (DeletePhotoFile $deletePhotoFile)
    {
        dump($deletePhotoFile);
        $this->photoManager->deleteImage($deletePhotoFile->getFilename()); 
    }
}
