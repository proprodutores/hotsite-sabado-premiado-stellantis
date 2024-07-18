<?php

declare(strict_types=1);

namespace App\Controller\Api; // Ou App\Controller

use Cake\Utility\Security;
use Firebase\JWT\JWT;

use Cake\View\JsonView;

class UsersController extends AppController
{
    public function login()
    {
        $this->request->allowMethod(['post']);
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $privateKey = file_get_contents(CONFIG . '/jwt.key');
            $user = $result->getData();
            $payload = [
                'iss' => 'hotsite_sabado_premiado_stellantis',
                'sub' => $user->id,
                'exp' => time() + 60,
            ];
            $userData = [
                'id' => $user->id,
                'username' => $user->login,
            ];
            $json = [
                'success' => true,
                'message' => 'Login successful',
                'token' => JWT::encode($payload, $privateKey, 'RS256'),
                'user' => $userData,
            ];
        } else {
            $this->response = $this->response->withStatus(401); // Unauthorized
            $json = [
                'success' => false,
                'message' => 'Invalid username or password',
                'result' => $result->isValid(),
            ];
        }

        return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode($json));
    }
}
