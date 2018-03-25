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
        $users = [
            'hello',
            'user',
            'editor',
            'creator',
            'destroyer',
        ];

        foreach ($users as $user) {
            \App\User::query()->create([
                'name' => $user,
                'email' => "{$user}@enea.io",
                'password' => bcrypt('nano'),
            ]);
        }
    }
}
