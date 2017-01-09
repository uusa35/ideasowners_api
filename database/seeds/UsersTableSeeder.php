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
        factory(User::class, 1)->create(['email' => 'test@test.com']);
        factory(User::class, 1)->create(['email' => 't']);
        factory(User::class, 5)->create()->each(function () {
            factory(Post::class, 10)->create();
        });
    }
}
