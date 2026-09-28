<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function index()
    {
        return view('home', [
            'customerCount' => (new CustomerModel())->countAllResults(),
            'userCount'     => (new UserModel())->countAllResults(),
        ]);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'message' => 'Welcome to my CodeIgniter website!'
        ];

        return view('about', $data);
    }

    public function students()
    {
        $data['students'] = [
            'Juan Dela Cruz',
            'Maria Santos',
            'Jose Reyes',
            'Ana Garcia'
        ];

        return view('students', $data);
    }
}
