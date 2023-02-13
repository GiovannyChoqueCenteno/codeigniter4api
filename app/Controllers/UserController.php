<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use CodeIgniter\API\ResponseTrait;

class UserController extends BaseController
{
    use ResponseTrait;
     
    public function index()
    {
        $users = new Usuario();
        return $this->respond(['users' => $users->findAll()], 200);
    }
}
