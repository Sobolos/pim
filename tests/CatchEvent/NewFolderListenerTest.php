<?php


namespace CatchEvent;


use App\CatchEvent\NewFolderListener;
use PHPUnit\Framework\TestCase;
use Pimcore\Event\Model\DataObjectEvent;
use App\Fakes\Folder;
use Symfony\Component\Messenger\MessageBus;

class NewFolderListenerTest extends TestCase
{

    protected DataObjectEvent $postEvent;
    protected NewFolderListener $folderListener;
    protected MessageBus $messageBus;

    public function setUp(): void
    {
        $folder = Folder::create([
            "o_parentId" => "1",
            "o_creationDate" => 1667210842,
            "o_userOwner" => 2,
            "o_userModification" => 2,
            "o_key" => "folder 1",
            "o_published" => true
        ]);

        $this->messageBus = new MessageBus();

        $this->postEvent = new DataObjectEvent($folder, []);
        $this->folderListener = new NewFolderListener($this->messageBus);
    }

    public function testCanGetNewFolderObject()
    {
        $result = $this->folderListener->onPostAdd($this->postEvent);
        $this->assertEquals(true, $result);
    }
}
