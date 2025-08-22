<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends BaseController
{
    use ResponseTrait;

    public function index(): string
    {
        $data['title'] = 'Hoşgeldiniz';
        return view('pages/auth/index', $data);
    }

    public function login(): ResponseInterface
    {
        // JSON veri kontrolü
        if ($this->request->getHeaderLine('Content-Type') !== 'application/json') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Sadece JSON veri kabul edilmektedir'
                ]);
        }

        $json = $this->request->getJSON();
        $email = $json->email ?? null;
        $password = $json->password ?? null;

        if (empty($email) || empty($password)) {
            return $this->fail('E-posta ve şifre gereklidir');
        }

        $user = $this->userModel->where(['email' => $email, 'password' => $this->userModel->encrypt($password)])->first();
        //var_dump($this->userModel->encrypt($password));exit();
        if ($user == null) {
            return $this->fail('Geçersiz kimlik bilgileri', 401);
        }

        $token = $this->generateToken($user);
        $decodedToken = JWT::decode($token, new Key(Services::getSecretKey(), 'HS256'));

        session()->set([
            'jwtToken' => $token,
            'loggedUser' => $user,
            'isLoggedIn' => true
        ]);

        return $this->respond([
            'status' => 'success',
            'message' => 'Giriş başarılı, Hoşgeldiniz ' . $user['name_surname'],
            'token' => $token,
            'token_expires' => date('Y-m-d H:i:s', $decodedToken->exp),
            'data' => [
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name_surname'],
                    'email' => $user['email'],
                    'type' => $user['type']
                ]
            ]
        ]);
    }

    public function logout(): ResponseInterface
    {
        $token = session()->get('jwtToken');

        // Token'ı blacklist'e al
        if ($token) {
            try {
                $decoded = JWT::decode($token, new Key(Services::getSecretKey(), 'HS256'));
                cache()->save('jwt_blacklist_'.$token, true, $decoded->exp - time());
            } catch (Exception $e) {
                // Token zaten geçersiz olabilir
            }
        }

        session()->remove(['loggedUser', 'isLoggedIn', 'jwtToken']);

        return $this->respond([
            'status' => 'success',
            'message' => 'Hesabınızdan güvenli bir şekilde çıkış yapıldı.',
            'token_invalidated' => $token !== null
        ]);
    }

    protected function generateToken(array $user): string
    {
        $key = Services::getSecretKey();

        $payload = [
            'iat' => time(),
            'exp' => time() + 86400, // 1 gün geçerli
            'uid' => $user['id'],
            'email' => $user['email'],
            'session_id' => session_id()
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
}