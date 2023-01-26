<?php

declare(strict_types=1);

namespace Model;


class User implements BaseModel
{

    public function __construct(public int $id, public string $name, public string $email)
    {
    }

    public static function all(): array
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("SELECT * FROM users");
        $statement->execute();
        $result = $statement->fetchAll();

        $users = [];
        foreach ($result as $row) {
            $users[] = new User($row['id'], $row['name'], $row['email']);
        }

        return $users;
    }

    public static function find(int $id): User
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("SELECT * FROM users WHERE id = :id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            throw new \Exception("User not found");
        }

        return new User($result['id'], $result['name'], $result['email']);
    }


    public function update(): User
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("UPDATE users SET name = :name, email = :email");
        $statement->execute(['name' => $this->name, 'email' => $this->email, 'id' => $this->id]);

        return $this;
    }

    public static function delete(int $id): void
    {
        $connection = Database::getConnection();

        $statement = $connection->prepare("DELETE FROM users WHERE id = :id");
        $statement->execute(['id' => $id]);
    }




}