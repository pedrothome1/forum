<?php

use App\Reply;
use App\Thread;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $thread = factory(Thread::class)->create();

        factory(Reply::class, 50)->create(['thread_id' => $thread->id]);

        factory(Thread::class, 6)->create();

        DB::table('users')->insert([
            'name' => 'Pedro Henrique',
            'email' => 'admin@forum.com',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'is_admin' => true
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
