<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for($i = 1; $i < 10; $i++)
        {
            DB::table('books')->insert([
                'category_id' => rand(1,4),
                'author_id' => rand(1,4),
                'book_title' => Str::random(10),
                'book_summary' => Str::random(20),
                'book_price' => rand(20,40),
                'book_cover_photo' => '',
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
        }
    }
}
