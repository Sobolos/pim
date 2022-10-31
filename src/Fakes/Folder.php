<?php


namespace App\Fakes;


use Pimcore\Model\DataObject;

class Folder extends DataObject
{
    /**
     * {@inheritdoc}
     */
    protected $o_type = 'folder';

    /**
     * @param array $values
     *
     * @return Folder
     * @throws \Exception
     */
    public static function create(array $values): Folder
    {
        $object = new static();
        self::checkCreateData($values);
        $object->setValues($values);

        return $object;
    }
}
