<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'admin@admin.com',
                'name' => 'Administrador',
                'password' => bcrypt("adminadmin"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'email' => 'admin@fenics.com',
                'name' => 'Fenics',
                'password' => bcrypt("fenics@2018/2"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'email' => 'admin@fasa.com',
                'name' => 'Fasa',
                'password' => bcrypt("fasa@2018/2"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        DB::table('users')->delete();
        User::insert($data);
    }
}
