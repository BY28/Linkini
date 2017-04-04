<?php

use Illuminate\Database\Seeder;

class PageCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('page_categories')->delete();

        $categories = array(

        		array('name' => 'home_advertisement')

        	);

        DB::table('page_categories')->insert($categories);
    }
}
