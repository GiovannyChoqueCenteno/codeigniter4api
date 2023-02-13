<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class FacturaController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        //
        return $this->respond(
            [
                'success' => true
            ]
        );
    }
    public function show(int $id){

    }
}
