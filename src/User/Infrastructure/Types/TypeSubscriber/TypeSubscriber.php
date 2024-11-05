<?php

namespace App\Infrastructure\Types\TypeSubscriber;

use App\Infrastructure\Types\EmailType;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LoadClassMetadataEventArgs;

class TypeSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::loadClassMetadata,
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $types = [
            EmailType::EMAIL => EmailType::class,
            //PhoneNumberType::PHONE_NUMBER => PhoneNumberType::class,
            //UuidType::UUID => UuidType::class,
        ];

        foreach ($types as $name => $class) {
            if (!Type::hasType($name)) {
                Type::addType($name, $class);
            }
        }
    }
}
