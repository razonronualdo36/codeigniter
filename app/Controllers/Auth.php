<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(site_url('customers'));
        }

        return view('login', ['title' => 'Staff Login']);
    }

    public function authenticate()
    {
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required|max_length[72]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user     = (new UserModel())->where('username', $username)->first();

        if ($user === null || ! password_verify($password, (string) $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $session = session();
        $session->regenerate(true);
        $session->set([
            'userId'     => $user['id'],
            'username'   => $user['username'],
            'fullName'   => $user['full_name'],
            'isLoggedIn' => true,
        ]);

        $destination = $session->get('intendedUrl') ?: site_url('customers');
        $session->remove('intendedUrl');

        return redirect()->to($destination)->with('success', 'Welcome, ' . $user['full_name'] . '.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}
