<?php

namespace Model;

class dtoUser
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ) {
    }
}