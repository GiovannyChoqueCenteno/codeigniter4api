<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class LoginController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        //
        $usuarioModel = new Usuario();
        $loginUsr = $this->request->getPost('login_usr');
        $password = $this->request->getPost('password');
        $usuario = $usuarioModel->where('login_usr',$loginUsr)->first();
        if( is_null($usuario)){
            return $this->respond(
                [
                    'error' => 'Invalido usuario o contraseña'
                ],
                404
            );
        }
        $pwd_verify = $usuario['password']== md5($password);
        if (!$pwd_verify){
            return $this->respond(
                [
                    'error' => 'Invalido usuario o contraseña'
                ],
                404
            );
        }
        $key = getenv('JWT_SECRET');
        $iat = time();
        $exp = $iat + 3600;
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "login_usr" => $usuario['login_usr'],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
        return $this->respond($response, 200);
    }
}
