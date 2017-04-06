<?php

namespace App\Repositories;

use App\Tag;

use Illuminate\Support\Str;

class TagRepository extends ResourceRepository
{

    protected $tag;

    public function __construct(Tag $tag)
	{
		$this->model = $tag;
	}

	public function store(Array $inputs)
	{
		$tags = explode('+', $inputs['tags']);

		foreach ($tags as $tag) {

			$tag = trim($tag);

			$tag_url = Str::slug($tag);

			$tag_ref = $this->model->where('tag_url', $tag_url)->first();

			if(is_null($tag_ref))
			{
				$tag_ref = new $this->model([
					'tag' => $tag,
					'tag_url' => $tag_url
				]);	

				$tag_ref->save();
			}

		}

	}

	public function attach($project, $tags)
	{
		$tags = explode('+', $tags);

		foreach ($tags as $tag) {

			$tag = trim($tag);

			$tag_url = Str::slug($tag);

			$tag_ref = $this->model->where('tag_url', $tag_url)->first();

			if(is_null($tag_ref)) 
			{
				//continue;
				$tag_ref = new $this->model([
					'tag' => $tag,
					'tag_url' => $tag_url
				]);	

				$project->tags()->save($tag_ref);

			} else {
			
				$project->tags()->attach($tag_ref->id);

			}

		}
	}

	public function getByName($name)
	{
		return $this->model->where('tag', $name)->first();
	}

	public function getByURL($slug)
	{
		return $this->model->where('tag_url', $slug)->first();
	}

	public function getSearchedTags($inputs)
	{
		return $this->model->where('tag', 'LIKE', '%'.$inputs['search'].'%')->get();
	}
}