<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fullname')->after('password');
            $table->string('avatar')->after('fullname');
            $table->string('phone')->after('avatar');
            $table->dateTime('birth_day')->nullable($value = true)->after('phone');
            $table->dateTime('start_date')->nullable($value = true)->after('birth_day');
            $table->Integer('department_id')->after('start_date');
            $table->Integer('role_id')->after('department_id');
            $table->boolean('is_admin')->default(0)->after('role_id');
            $table->boolean('is_first_login')->default(1)->after('is_admin');
            $table->boolean('status')->default(1)->after('is_first_login');
            $table->softDeletes();
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('fullname');
            $table->dropColumn('avatar');
            $table->dropColumn('phone');
            $table->dropColumn('birth_day');
            $table->dropColumn('start_date');
            $table->dropColumn('department_id');
            $table->dropColumn('role_id');
            $table->dropColumn('is_admin');
            $table->dropColumn('is_first_login');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
}
