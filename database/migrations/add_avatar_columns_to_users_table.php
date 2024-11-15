<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kiểm tra xem cột đã tồn tại chưa trước khi thêm
            if (!Schema::hasColumn('users', 'avatar_color')) {
                $table->string('avatar_color')->nullable();
            }
            if (!Schema::hasColumn('users', 'avatar_svg')) {
                $table->text('avatar_svg')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar_color', 'avatar_svg']);
        });
    }
};