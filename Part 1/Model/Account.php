<?php

declare(strict_types=1);

namespace Model;

use DateTime;
use Enums\Type;

class Account implements BaseModel
{

    public function __construct(public int $id, public float $balance, public Type $type, public int $user_id, public ?DateTime $timestamp)
    {
    }

    public static function all(): array
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("SELECT * FROM accounts");
        $statement->execute();
        $result = $statement->fetchAll();

        $accounts = [];
        foreach ($result as $row) {
            $accounts[] = new Account($row['id'], (float)$row['balance'], Type::takeString(strtoupper($row['type'])), $row['user_id'], new DateTime($row['timestamp']));
        }

        return $accounts;
    }

    public static function allOfUser(int $user_id): array
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("SELECT * FROM accounts WHERE user_id = :user_id");
        $statement->execute(['user_id' => $user_id]);
        $result = $statement->fetchAll();

        $accounts = [];
        foreach ($result as $row) {
            $accounts[] = new Account($row['id'], (float)$row['balance'], Type::takeString(strtoupper($row['type'])), (int)$row['user_id'], new DateTime($row['timestamp']));
        }

        return $accounts;
    }

    public static function find(int $id): Account
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("SELECT * FROM accounts WHERE id = :id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        return new Account($result['id'], (float)$result['balance'], Type::takeString(strtoupper($result['type'])), $result['user_id'], new DateTime($result['timestamp']));
    }


    public function update(): Account
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("UPDATE accounts SET balance = :balance, type = :type, user_id = :user_id, timestamp = :timestamp WHERE id = :id");
        $statement->execute([
            'id' => $this->id,
            'balance' => $this->balance,
            'type' => $this->type->makeString(),
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp->format('Y-m-d H:i:s'),
        ]);

        return $this;
    }

}
