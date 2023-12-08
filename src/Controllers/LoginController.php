<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view(name: 'login', title: 'Вход');
    }

    public function login()
    {
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');
        $this->session()->set('emailInput',"$email");
        $this->session()->set('passwordInput',"$password");
        if ($this->auth()->attempt($email, $password)) {
            $this->redirect('/');
        }

        $this->session()->set('error', 'Неверный логин или пароль');

        $this->redirect('/login');
    }

    public function logout(): void
    {
        $this->auth()->logout();
        $this->session()->remove('emailInput');
        $this->session()->remove('passwordInput');
        $this->redirect('/login');
    }
}
