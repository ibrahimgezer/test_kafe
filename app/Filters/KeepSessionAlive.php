<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class KeepSessionAlive implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
       /* if ($session->has('qrData')) {
            $session->set('qrData', $session->get('qrData')); // Süreyi yeniler
        }*/
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}