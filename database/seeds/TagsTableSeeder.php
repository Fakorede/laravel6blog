<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Science', 'Technology', 'Sports', 'Business', 'Politics', 'Entertainment']);

        $tags->each(function($name) {
            $tag = new Tag();
            $tag->name = $name;
            $tag->save();
        });
    }
}
