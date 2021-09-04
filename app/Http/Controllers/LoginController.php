<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class LoginController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        $this->userRepository->login();

        return back();
    }
}
