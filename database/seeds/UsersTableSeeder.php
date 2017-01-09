<?php

use App\Post;
use App\User;
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
        if(app()->environment() === 'production') {
            factory(User::class, 1)->create(['email' => 'info@ideasowners.net','password' => bcrypt('Ideasowners123#@!_api')]);
        }
        factory(User::class, 1)->create(['email' => 'test@test.com']);
        factory(User::class, 1)->create(['email' => 't']);
        factory(User::class, 5)->create()->each(function () {
            factory(Post::class, 10)->create();
        });
    }
}
