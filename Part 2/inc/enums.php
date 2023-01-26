<?php declare(strict_types=1);

namespace inc;

enum enums
{
    case BALANCE;
    case CHECKING;

    public static function takeString(string $type): Type
    {
        return match ($type) {
            'SAVINGS' => Type::BALANCE,
            'CHECKING' => Type::CHECKING,
            default => throw new \Exception('Invalid type'),
        };
    }

    public function makeString(): string
    {
        return match ($this) {
            Type::SAVINGS => 'BALANCE',
            Type::CHECKING => 'CHECKING',
        };
    }
}
