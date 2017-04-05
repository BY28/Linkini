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

        		array('name' => 'home_advertisement'),
                array('name' => 'page_header'),
                array('name' => 'page_about'),
                array('name' => 'page_services'),
                array('name' => 'page_contact')

        	);

        DB::table('page_categories')->insert($categories);
    }
}
