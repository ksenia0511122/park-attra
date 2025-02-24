<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function users() {
        // Возвращает список всех пользователей
        return response()->json(User::all());
    }

    public function deleteUser($id) {
        // Находит пользователя по ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Удаляет пользователя
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
