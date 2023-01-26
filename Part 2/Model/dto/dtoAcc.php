<?php

namespace Model;

use inc\enums;

class dtoAcc
{
    public function __construct(
        public int $id,
        public float $balance,
        public Type $type,
        public int $user_id,
        public ?string $timestamp
    ) {
    }
}
