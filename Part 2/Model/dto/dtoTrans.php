<?php

namespace Model;

class dtoTrans
{
    public function __construct(
        public int $id,
        public int $from_account_id,
        public int $to_account_id,
        public float $amount,
        public string $timestamp
    ) {
    }
}