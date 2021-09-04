<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function login()
    {
        Auth::login($this->getFirstUser());
    }

    private function getFirstUser()
    {
        if (!$user = $this->model->first()) {
            $user = $this->model->factory()->create();
        }

        return $user;
    }
}
