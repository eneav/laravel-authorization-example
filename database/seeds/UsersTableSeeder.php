<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::query()->create([
            'name' => 'enea',
            'email' => 'hello@enea.io',
            'password' => bcrypt('nano'),
        ]);

        \App\User::query()->create([
            'name' => 'user',
            'email' => 'user@enea.io',
            'password' => bcrypt('nano'),
        ]);
    }
}
