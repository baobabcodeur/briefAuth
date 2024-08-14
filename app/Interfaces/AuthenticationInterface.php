<?php

namespace App\Interfaces;

interface AuthenticationInterface
{
    public function login(array $data);
    public function registration(array $data);
}
