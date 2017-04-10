<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
    	'page_category_id', 'content_title', 'content_sub_title', 'content_text', 'image'
    ];
}
