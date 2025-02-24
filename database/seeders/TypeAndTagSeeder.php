<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\Tag;

class TypeAndTagSeeder extends Seeder
{
    public function run()
    {
        // Заполняем таблицу типов аттракционов
        $types = ['Детский', 'Семейный', 'Экстремальный'];
        foreach ($types as $type) {
            Type::updateOrCreate(['name' => $type]);
        }

        // Заполняем таблицу тегов (возрастные ограничения)
        $tags = [
            ['name' => 'до 3 лет', 'age_limit' => 3],
            ['name' => 'до 7 лет', 'age_limit' => 7],
            ['name' => 'до 12 лет', 'age_limit' => 12],
            ['name' => 'от 12 лет', 'age_limit' => 12]
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(['name' => $tag['name']], ['age_limit' => $tag['age_limit']]);
        }
    }
}

