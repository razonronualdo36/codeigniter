<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('home');
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