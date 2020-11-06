<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        \App\Models\Article::factory(20)->create();
        \App\Models\Tag::factory(20)->create();
        $tags = \App\Models\Tag::all();
        \App\Models\Article::all()->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
