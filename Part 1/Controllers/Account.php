<?php

declare(strict_types=1);

namespace Controllers;

use DateTime;
use Model\Account;
use inc\enums;

class AccountController implements BaseController
{
    public function index()
    {
        $accounts = Account::all();

        foreach($accounts as $account) {
            echo json_encode(['balance' => $account->balance, 'type' => $account->type->makeString(), 'user_id' => $account->user_id, 'timestamp' => $account->timestamp]);
        }
    }

    // (int $id)
    public function indexOfUser()
    {
        $id = (int)$_GET['id'];

        $accounts = Account::allOfUser($id);

        foreach($accounts as $account) {
            echo json_encode(['balance' => $account->balance, 'type' => $account->type->makeString(), 'user_id' => $account->user_id, 'timestamp' => $account->timestamp]);
        }
        
    }

    // (int $id)
    public function show()
    {
        $id = (int)$_GET['id'];

        $account = Account::find($id);
        echo json_encode(['balance' => $account->balance, 'type' => $account->type->makeString(), 'user_id' => $account->user_id, 'timestamp' => $account->timestamp]);
    }

    // (Account $account)
    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $account = new Account(0, $data['balance'],  Type::takeString(strtoupper($data['type'])), $data['user_id'], new DateTime());

        $account = Account::create($account);
        echo json_encode(['balance' => $account->balance, 'type' => $account->type->makeString(), 'user_id' => $account->user_id, 'timestamp' => $account->timestamp]);
    }

    // (Account $account)
}
