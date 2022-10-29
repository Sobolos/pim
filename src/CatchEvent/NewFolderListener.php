<?php


namespace App\CatchEvent;

use App\Message\NewFolderMessage;
use Pimcore\Event\Model\ElementEventInterface;
use Pimcore\Event\Model\DataObjectEvent;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;


class NewFolderListener extends AbstractController
{
    private LoggerInterface $logger;
    private MessageBusInterface $messageBus;

    public function __construct(LoggerInterface $logger, MessageBusInterface $messageBus) {
        $this->logger = $logger;
        $this->messageBus = $messageBus;
    }

    public function onPostAdd (ElementEventInterface $e) {
        if ($e instanceof DataObjectEvent) {
            // do something with the object
            $foo = $e->getObject();

            $type = $foo->getType();

            if($type === "folder")
            {
                $this->logger->alert("folder added", ["id" => $foo->getId(), "path" => $foo->getRealFullPath()]);

                $message = new NewFolderMessage($foo->getId(), $foo->getRealFullPath());
                $this->messageBus->dispatch($message);
            }
        }
    }
}
