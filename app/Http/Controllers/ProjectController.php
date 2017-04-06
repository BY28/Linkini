<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;

use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;
use App\Repositories\LinkRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ActivityRepository;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;
    protected $tagRepository;
    protected $linkRepository;
    protected $categoryRepository;

    protected $nbrPerPage = 12;

    public function __construct(ProjectRepository $projectRepository, TagRepository $tagRepository, LinkRepository $linkRepository, CategoryRepository $categoryRepository)
    {
        $this->middleware('auth', ['except' => 'index']);

        $this->projectRepository = $projectRepository;
        $this->tagRepository = $tagRepository;
        $this->linkRepository = $linkRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        $projects = $this->projectRepository->getPaginate($this->nbrPerPage);
        $links = $projects->render();
        $categories = $this->categoryRepository->categories();
        
        return view('projects.index', compact('projects', 'links', 'categories'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $categories = $this->categoryRepository->categories();

        return view('profiles.projects.create', compact('user', 'categories'));
    }

    public function store(ProjectCreateRequest $request, TagRepository $tagRepository)
    {
        $category = $this->categoryRepository->getByName($request->input('category'));

        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id, 'category_id' => $category->id]);
        
        $project = $this->projectRepository->store($inputs);

        if(isset($inputs['tags']))
        {
            $tagRepository->attach($project, $inputs['tags']);
        }

        return redirect('projects')->withOk("Le project " . $project->title . " a été créé.");
    }

    public function show(Request $request, $id)
    {
        $this->linkRepository->checkSeen($request->user(), $id);
        $project = $this->projectRepository->getById($id);
        $categories = $this->categoryRepository->categories();

        return view('projects.show',  compact('project', 'categories'));
    }

    public function edit($id)
    {
        $project = $this->projectRepository->getById($id);

        return view('projects.edit',  compact('project'));
    }

    public function update(Request $request, TagRepository $tagRepository, $id)
    {

        $project = $this->projectRepository->getById($id);
        $category = $this->categoryRepository->getByName($request->input('category'));

        $inputs = array_merge($request->all(), ['category_id' => $category->id]);
        
        $this->projectRepository->update($id, $request->all());

       /* if(isset($inputs['tags']))
        {
           $projectTags = $project->tags();
           $projectTagsArray[] = null;

           foreach ($projectTags as $tag) {
               $projectTagsArray[] = $tag->tag;
           }

           $inputTagsArray = explode('+', $inputs['tags']);
           $timtags[] = null;
           foreach ($inputTagsArray as $tag) {
               $tag = trim($tag);
               $trimTags[] = $tag;
           }

           $i = 0;
           foreach ($trimTags as $tag) {
              if(in_array($tag, $projectTagsArray))
              {
                unset($trimTags[$i]);
              }
              $i++;
           }
           $i=0;
            
            //$attachInputs = array_diff($trimTags, $projectTagsArray);
            $inputProjects = implode('+', $trimTags);
            $tagRepository->attach($project, $inputProjects);
        }*/

    
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->projectRepository->destroy($id);

        return back();
    }

    public function indexTag($tag)
    {
        $tags = explode('+', $tag);
            //$tag = $this->tagRepository->getByName($request->input('tags-input'));
            $projects = $this->projectRepository->getWithUserAndTagsForTagPaginate(/*$tag->tag*/$tags, $this->nbrPerPage);
            $links = $projects->render();
            $categories = $this->categoryRepository->categories();
        if($projects->count() > 0)
        {
            return view('projects.index', compact('projects', 'categories', 'links'))
                    ->with('info', 'Résultats pour la recherche : ' . $tag);
        }
        else
        {
            return view('projects.index', compact('projects', 'categories', 'links'))
                    ->with('info', 'Aucun résultat pour la recherche : ' . $tag);
        }
    }

    public function indexTitle($query)
    {
            
            $projects = $this->projectRepository->getProjectsFromTitle($query, $this->nbrPerPage);
            $links = $projects->render();
            $categories = $this->categoryRepository->categories();
        if($projects->count() > 0)
        {
            return view('projects.index', compact('projects', 'categories', 'links'))
                    ->with('info', 'Résultats pour la recherche : ' . $query);
        }
        else
        {
            return view('projects.index', compact('projects', 'categories', 'links'))
                    ->with('info', 'Aucun résultat pour la recherche : ' . $query);
        }
    }

    public function getUserProjects(Request $request)
    {
        $user = $request->user();
        $projects = $this->projectRepository->getUserProjects($user->id);
        
        return view('profiles.projects.all', compact('projects', 'user'));
    }

     public function getPending(Request $request)
    {
        $projects = $this->projectRepository->getPending();
        $user = $request->user();

        return view('profiles.projects.pending', compact('projects', 'user'));
    }

    public function getLaunched(Request $request)
    {
        $projects = $this->projectRepository->getLaunched();
        $user = $request->user();

        return view('profiles.projects.launched', compact('projects', 'user'));
    }

    public function launch(Request $request)
    {
        $this->projectRepository->launch($request->all());
    }

    public function indexCategory($category)
    {
        $categoryObject = $this->categoryRepository->getByURL($category);
        $projects = $this->projectRepository->getWithUserAndCategoriesForCategoryPaginate($category, $this->nbrPerPage);
        $links = $projects->render();
        $categories = $this->categoryRepository->categories();

        return view('projects.index', compact('projects', 'categories', 'links'))
        ->with('info', 'Résultats pour la recherche de la categorie : ' . $categoryObject->name);
    }
}
