<?php

namespace App\MessageHandler;

use App\Photo\PhotoFileManager;
use App\Message\DeleteImagePost;
use Doctrine\ORM\EntityManagerInterface;
use App\Message\Event\ImagePostDeletedEvent;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteImagePostHandler implements MessageHandlerInterface
{
    protected $entityManager;
    protected $eventBus;

    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $eventBus)
    {
        $this->entityManager = $entityManager;
        $this->eventBus = $eventBus;
    }

    public function __invoke(DeleteImagePost $deleteImagePost)
    {
        $imagePost = $deleteImagePost->getImagePost();
        $filename = $imagePost->getFilename();

        $this->entityManager->remove($imagePost);
        $this->entityManager->flush();

        $this->eventBus->dispatch(new ImagePostDeletedEvent($filename));
    }
}
