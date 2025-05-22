<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'username' => '',
    'email' => '',
    'sexo' => '',
    'telefono' => '',
    'direccion' => '',
    'fecha_registro' => '',
    'ci' => '',
    'tipo_usuario' => '',
    'id_rol' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'sexo' => ['required', 'in:masculino,femenino,otro'],
    'telefono' => ['required', 'numeric', 'digits_between:7,15'],
    'direccion' => ['required', 'string', 'max:255'],
    'fecha_registro' => ['required', 'date'],
    'ci' => ['required', 'numeric', 'digits_between:6,15'],
    'tipo_usuario' => ['required', 'in:A,E,I'],
    'id_rol' => ['required', 'exists:rols,id'],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>


<div>
    <form wire:submit="register" style="margin-right: 200px;margin-left: 200px;padding-top: 100px;border-bottom-width: px;">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="mt-4">
            <x-input-label for="sexo" :value="__('Sexo')" />
            <select wire:model="sexo" id="sexo" name="sexo" class="block mt-1 w-full">
                <option value="masculino">{{ __('Masculino') }}</option>
                <option value="femenino">{{ __('Femenino') }}</option>
                <option value="otro">{{ __('Otro') }}</option>
            </select>
            <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
        </div>

        <!-- Telefono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input wire:model="telefono" id="telefono" class="block mt-1 w-full" type="text" name="telefono" required autocomplete="telefono" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Direccion -->
        <div class="mt-4">
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input wire:model="direccion" id="direccion" class="block mt-1 w-full" type="text" name="direccion" required autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Fecha Registro -->
        <div class="mt-4">
            <x-input-label for="fecha_registro" :value="__('Fecha de Registro')" />
            <x-text-input wire:model="fecha_registro" id="fecha_registro" class="block mt-1 w-full" type="date" name="fecha_registro" required autocomplete="fecha_registro" />
            <x-input-error :messages="$errors->get('fecha_registro')" class="mt-2" />
        </div>

        <!-- CI -->
        <div class="mt-4">
            <x-input-label for="ci" :value="__('CI')" />
            <x-text-input wire:model="ci" id="ci" class="block mt-1 w-full" type="text" name="ci" required autocomplete="ci" />
            <x-input-error :messages="$errors->get('ci')" class="mt-2" />
        </div>

        <!-- Tipo Usuario -->
        <div class="mt-4">
            <x-input-label for="tipo_usuario" :value="__('Tipo de Usuario')" />
            <select wire:model="tipo_usuario" id="tipo_usuario" name="tipo_usuario" class="block mt-1 w-full">
                <option value="A">{{ __('Administrador') }}</option>
                <option value="E">{{ __('Estudiante') }}</option>
                <option value="I">{{ __('Instructor') }}</option>
            </select>
            <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-2" />
        </div>

        <!-- ID Rol -->
        <div class="mt-4">
            <x-input-label for="id_rol" :value="__('Rol')" />
            <x-text-input wire:model="id_rol" id="id_rol" class="block mt-1 w-full" type="number" name="id_rol" required autocomplete="id_rol" />
            <x-input-error :messages="$errors->get('id_rol')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
