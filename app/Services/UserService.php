<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function handleGetAllUser()
    {
        $data = $this->user->all();
        return $data;
    }
}