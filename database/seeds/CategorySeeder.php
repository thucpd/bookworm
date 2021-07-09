<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for($i = 1; $i < 5; $i++)
        {
            DB::table('categories')->insert([
                'category_name' => 'Category_'.$i.$i,
                'category_desc' => Str::random(20),
            ]);
        }

    }
}
