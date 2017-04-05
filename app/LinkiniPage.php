<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkiniPage extends Model
{
    protected $fillable = [
    	'entreprise_id', 'page_category_id', 'content_title', 'content_sub_title', 'content_text', 'image'
    ];

    public function page()
    {
    	return $this->belongsTo('App\Entreprise');
    }
}
