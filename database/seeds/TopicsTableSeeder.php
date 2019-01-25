<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        // 取出所有用户的id列表
        $user_ids = User::all()->pluck('id')->toArray();

        // 取出所有分类id
        $category_ids = Category::all()->pluck('id')->toArray();

        // 获取faker实例
        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) use ($user_ids, $category_ids, $faker) {
            // 从用户id数组中随机取出一个id，赋值给当前遍历的topic对象
            $topic->user_id = $faker->randomElement($user_ids);

            // 从分类id数组中随机取出一个id，赋值给当前遍历的topic对象
            $topic->category_id = $faker->randomElement($category_ids);
        });

        // 将topic集合转化为数组，插入表中
        Topic::insert($topics->toArray());
    }

}

