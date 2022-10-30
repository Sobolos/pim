<?php


namespace App\CatchEvent;

use App\Message\NewFolderMessage;
use Pimcore\Event\Model\ElementEventInterface;
use Pimcore\Event\Model\DataObjectEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;


class NewFolderListener extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function onPostAdd(ElementEventInterface $e): bool
    {
        if ($e instanceof DataObjectEvent){
            $eventObject = $e->getObject();
            $type = $eventObject->getType();

            if($type === "folder"){
                $message = new NewFolderMessage($eventObject->getId(), $eventObject->getRealFullPath());
                $this->messageBus->dispatch($message);

                return true;
            }

            return false;
        }

        return false;
    }
}
