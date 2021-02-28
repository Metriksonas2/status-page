<?php 

abstract class Loader{

    protected $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    abstract protected function convertToObject($object);
}