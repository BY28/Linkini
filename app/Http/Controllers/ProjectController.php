<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;

use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;

    protected $nbrPerPage = 9;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->middleware('auth', ['except' => 'index']);

        $this->projectRepository = $projectRepository;
    }
      public function index()
    {
        $projects = $this->projectRepository->getPaginate($this->nbrPerPage);
        $links = $projects->render();
        
        return view('projects.index', compact('projects', 'links'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(ProjectCreateRequest $request, TagRepository $tagRepository)
    {
        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);
        
        $project = $this->projectRepository->store($inputs);

        if(isset($inputs['tag']))
        {
            $tagRepository->attach($project, $inputs['tag']);
        }

        return redirect('project')->withOk("La projecte " . $project->title . " a été créée.");
    }

    public function show($id)
    {
        $project = $this->projectRepository->getById($id);

        return view('projects.show',  compact('project'));
    }

    public function edit($id)
    {
        $project = $this->projectRepository->getById($id);

        return view('projects.edit',  compact('project'));
    }

    public function update(ProjectUpdateRequest $request, $id)
    {

        $this->projectRepository->update($id, $request->all());
        
        return redirect('project')->withOk("La projecte " . $request->input('title') . " a été modifiée.");
    }

    public function destroy($id)
    {
        $this->projectRepository->destroy($id);

        return back();
    }

    public function indexTag($tag)
    {
        $projects = $this->projectRepository->getWithUserAndTagsForTagPaginate($tag, $this->nbrPerPage);
        $links = $projects->render();

        return view('projects.liste', compact('projects', 'links'))
        ->with('info', 'Résultats pour la recherche du mot-clé : ' . $tag);
    }
}
