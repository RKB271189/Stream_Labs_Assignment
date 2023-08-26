<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    private $table;
    public function __construct(User $user)
    {
        $this->table = $user;
    }
    public function saveDetails(array $params)
    {

        return $this->table->firstOrCreate([
            'googleid' => $params['google_id'],
        ], [
            'name' => $params['name'],
            'email' => $params['email'],
        ]);
    }
}
