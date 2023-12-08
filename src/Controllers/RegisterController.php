<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view(name: 'register', title: 'Регистрация');
    }

    public function register()
    {
        $this->session()->set('nameInput',$this->request()->input('name'));
        $this->session()->set('emailInput',$this->request()->input('email'));
        $this->session()->set('passwordInput',$this->request()->input('password'));
        $this->session()->set('password_confirmationInput',$this->request()->input('password_confirmation'));
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        $this->db()->insert('users', [
            'name' => $this->request()->input('name'),
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
        ]);
        $this->session()->remove('nameInput');
        $this->session()->remove('emailInput');
        $this->session()->remove('passwordInput');
        $this->session()->remove('password_confirmationInput');
        $this->redirect('/');
    }
}
