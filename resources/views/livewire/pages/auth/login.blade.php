<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $user = auth()->user();

    if ($user->tipo_usuario === 'A') {
        $this->redirect(route('admin.dashboard', absolute: false), navigate: true);
    } elseif ($user->tipo_usuario === 'E') {
        $this->redirect(route('estudiante.dashboard', absolute: false), navigate: true);
    } elseif ($user->tipo_usuario === 'I') {
        $this->redirect(route('instructor.dashboard', absolute: false), navigate: true);
    } else {
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};

?>


<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <nav class="bg-gray-900 text-white shadow-md sticky top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h2 class="m-0"><i class="fa fa-car text-primary me-2"></i>WUILLANS</h2>
        </a>

            <!-- Menú Principal -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" class="hover:text-gray-300 px-4">Inicio</a>
                <a href="about.html" class="hover:text-gray-300 px-4">Sobre Nosotros</a>
                <a href="courses.html" class="hover:text-gray-300 px-4">Cursos</a>
                <a href="https://web.whatsapp.com/" class="hover:text-gray-300">Contacto</a>
            </div>

            <!-- Botón del menú móvil -->
            <button class="md:hidden text-white focus:outline-none" id="menu-toggle">
                ☰
            </button>
        </div>

        <!-- Menú móvil -->
        <div class="hidden md:hidden flex flex-col items-center mt-4 space-y-4" id="mobile-menu">
            <a href="{{ url('/admin/dashboard') }}" class="text-white">Inicio</a>
            <a href="about.html" class="text-white">Sobre Nosotros</a>
            <a href="courses.html" class="text-white">Cursos</a>
            <a href="https://web.whatsapp.com/" class="text-white">Contacto</a>
        </div>
    </nav>
    <!-- Logo centrado -->
    <div class="flex justify-center">
        <img src="{{ asset('img/Autoescuela4.png') }}" alt="Logo Autoescuela" class="w-40 h-auto mb-6"
            style="padding-top: 100px;">
    </div>


    <form wire:submit="login" class="max-w-md mx-auto p-6 rounded-lg shadow-md">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuerdame') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Olvidaste tu Contraseña?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</div>
