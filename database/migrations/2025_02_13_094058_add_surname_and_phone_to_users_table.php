<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('surname')->after('name'); // Добавление фамилии после имени
        $table->string('phone')->nullable()->after('role'); // Добавление телефона после роли
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('surname');
        $table->dropColumn('phone');
    });
}

};
