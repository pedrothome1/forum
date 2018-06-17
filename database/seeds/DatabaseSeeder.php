<?php

use App\Reply;
use App\Thread;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Categories identifiers.
     *
     * @var array
     */
    protected $categoriesIds = [];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createWebDevelopmentRelatedCategories();
        $this->createThreadsWithReplies(18);

        DB::table('users')->insert([
            'name' => 'Pedro Henrique',
            'email' => 'admin@forum.com',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Create web development related categories.
     *
     * @return void
     */
    protected function createWebDevelopmentRelatedCategories()
    {
        factory(Category::class)->create(['name' => 'Laravel', 'color' => '#f4645f']);
        factory(Category::class)->create(['name' => 'PHP', 'color' => '#8892BF']);
        factory(Category::class)->create(['name' => 'Python', 'color' => '#3776ab']);
        factory(Category::class)->create(['name' => 'Ruby on Rails', 'color' => '#CC342D']);
        factory(Category::class)->create(['name' => 'JavaScript', 'color' => '#F0F700']);
        factory(Category::class)->create(['name' => 'Vue', 'color' => '#4fc08d']);
        factory(Category::class)->create(['name' => 'Django', 'color' => '#0C4B33']);
    }

    /**
     * Create threads with replies associated.
     *
     * @param  int  $threadsQuantity
     * @return void
     */
    protected function createThreadsWithReplies($threadsQuantity)
    {
        $ids = $this->getCategoriesIds();
        $count = count($ids);

        while ($threadsQuantity-- > 0) {
            $thread = factory(Thread::class)->create([
                'category_id' => $ids[rand(0, $count - 1)]
            ]);

            factory(Reply::class, rand(5, 13))->create(['thread_id' => $thread->id]);
        }
    }

    /**
     * Get the categories identifiers.
     *
     * @return array
     */
    protected function getCategoriesIds()
    {
        if (count($this->categoriesIds)) {
            return $this->categoriesIds;
        }

        return $this->categoriesIds = Category::pluck('id')->all();
    }
}
