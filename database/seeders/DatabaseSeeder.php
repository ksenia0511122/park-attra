<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Добавляем фасад для аутентификации

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Создаем или находим администратора
        $user = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'surname' => 'Admin', // Добавляем фамилию
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Явно авторизуем пользователя
        Auth::login($user);

        // Печатаем подтверждение
        echo "Пользователь авторизован: " . Auth::user()->name;
    }
}
