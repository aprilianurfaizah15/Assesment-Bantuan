<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    #[Layout('components.layouts.auth')]
    #[Title('Login')]

    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        session()->flash('error', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}