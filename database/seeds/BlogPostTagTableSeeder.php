<?php

use App\Tag;
use App\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if (!$tagCount) {
            $this->command->info('No tags found');
            return;
        }

        $minTag = (int) $this->command->ask('How many min. tags do you want on a blogpost?', 0);
        $maxTag = min((int) $this->command->ask('How many max. tags do you want on a blogpost?', $tagCount), $tagCount);

        BlogPost::all()->each(function(BlogPost $post) use($minTag, $maxTag) {
            $count = random_int($minTag, $maxTag);
            $tags = Tag::inRandomOrder()->take($count)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
