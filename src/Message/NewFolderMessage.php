<?php


namespace App\Message;


class NewFolderMessage
{
    /**
     * @var int|null
     */
    private int|null $id;

    /**
     * @var string|null
     */
    private string|null $path;

    /**
     * FolderCreatedEvent constructor.
     * @param int|null $id
     * @param string|null $path
     */
    public function __construct(int|null $id, string|null $path)
    {
        $this->id = $id;
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
