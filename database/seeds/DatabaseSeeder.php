<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->delete();

        $user = ['name' => 'test', 'email' => 'test@test.com', 'password' => Hash::make('qwerty')];
        User::create($user);

        Model::reguard();
    }
}
