<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[А-ЯЁ][а-яё]+$/u'],
            'surname' => ['required', 'string', 'regex:/^[А-ЯЁ][а-яё]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'regex:/^\+7\s?\(\d{3}\)\s?\d{3}-\d{2}-\d{2}$/'], // Разрешаем пробелы
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[A-Za-z]/', // Должен содержать буквы
                'regex:/[0-9]/'     // Должен содержать цифры
            ],
        ], [
            'name.regex' => 'Имя должно начинаться с заглавной буквы и содержать только буквы.',
            'surname.regex' => 'Фамилия должна начинаться с заглавной буквы и содержать только буквы.',
            'phone.regex' => 'Введите телефон в формате +7 (XXX) XXX-XX-XX.',
            'password.regex' => 'Пароль должен содержать хотя бы одну букву и одну цифру.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Удаляем пробелы, скобки и тире перед сохранением
        $cleanPhone = preg_replace('/\D+/', '', $request->phone);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $cleanPhone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Регистрация успешна! Войдите в аккаунт.');
    }
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('tickets')->with('success', 'Вы вошли в систему!');
        }

        return back()->withErrors(['email' => 'Неверный email или пароль']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Вы вышли из системы.');
    }
}
