<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_user')->nullable();
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('level')->nullable();
            $table->integer('status_user')->nullable();
            $table->timestamps();
        });
        // Insert some stuff
        User::insert([
            [
                'nama_user' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'level' => 'admin',
                'status_user' => 1,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user' => 'User',
                'username' => 'user',
                'password' => Hash::make('user'),
                'level' => 'user',
                'status_user' => 1,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
    }
}
