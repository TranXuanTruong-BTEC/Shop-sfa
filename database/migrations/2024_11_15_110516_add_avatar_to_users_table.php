<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('avatar_color')->nullable();
            $table->text('avatar_svg')->nullable();
        });
    }

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['avatar', 'avatar_color', 'avatar_svg']);
    });
}
};
