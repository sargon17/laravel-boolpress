<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "development",
            "time management",
            "laravel",
            "vue",
            "react",
            "sass",
        ];

        foreach ($tags as $tag) {
            Tag::create([
                "name" => $tag,
            ]);
        }
    }
}
