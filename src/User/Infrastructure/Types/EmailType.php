<?php

namespace App\Infrastructure\Types;

use App\Domain\ValueObject\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class EmailType extends Type
{
    const EMAIL = 'email';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getStringTypeDeclarationSQL([
            'length' => 255,
            'nullable' => false,
        ]);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        return new Email($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if(is_string($value)){
            return $value;
        }

        if (!$value instanceof Email) {
            throw new \InvalidArgumentException('Value should be an Email instance');
        }

        return $value->value();
    }

    public function getName()
    {
        return self::EMAIL;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}