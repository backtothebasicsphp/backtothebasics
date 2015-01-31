<?php

namespace Basic\Login\Repository;

use Basic\Login\Entity\User;
use PHPFluent\ArrayStorage\Record;
use PHPFluent\ArrayStorage\Storage;

class ArrayUserRepository implements UserRepository
{
    private $users;

    public function __construct(Storage $storage)
    {
        $this->users = $storage->users;
    }

    public function findByUsername($username)
    {
        $record = $this->users->find(array('username' => $username));

        if (!$record instanceof Record) {
            return false;
        }

        $user = new User();
        $user->setId($record->id);
        $user->setUsername($record->username);
        $user->setPassword($record->password);

        return $user;
    }
}
