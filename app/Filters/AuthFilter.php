<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('url');

        if (session()->get('isLoggedIn')) {
            return null;
        }

        if (strtoupper($request->getMethod()) === 'GET') {
            session()->set('intendedUrl', (string) $request->getUri());
        }

        return redirect()->to(site_url('login'))->with('error', 'Please log in to continue.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
