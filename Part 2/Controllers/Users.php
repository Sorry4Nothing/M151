<?php

declare(strict_types=1);

namespace Controllers;

use Model\User;
use ORM\Entity;

class UserController implements BaseController
{
    public function index()
    {
        $users = Entity::getEntityManager()->getRepository(User::class)->findAll();

        foreach ($users as $user) {
            echo json_encode(['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password]);
        }
    }

    // (int $id)
    public function show()
    {
        $id = $_GET['id'];

        $user = Entity::getEntityManager()->getRepository(User::class)->find($id);

        echo json_encode(['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password]);
    }

    // (User $user)
    public function update()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user = new UserDto($data['id'], $data['name'], $data['email'], $data['password']);

        $user = Entity::getEntityManager()->getRepository(User::class)->update($user);

        echo json_encode(['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password]);
    }
}
