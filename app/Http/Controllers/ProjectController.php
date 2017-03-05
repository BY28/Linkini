<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;

use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;
use App\Repositories\LinkRepository;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;
    protected $tagRepository;
    protected $linkRepository;

    protected $nbrPerPage = 9;

    public function __construct(ProjectRepository $projectRepository, TagRepository $tagRepository, LinkRepository $linkRepository)
    {
        $this->middleware('auth', ['except' => 'index']);

        $this->projectRepository = $projectRepository;
        $this->tagRepository = $tagRepository;
        $this->linkRepository = $linkRepository;
    }
    public function index(Request $request)
    {
        $projects = $this->projectRepository->getPaginate($this->nbrPerPage);
        $links = $projects->render();
        
        return view('projects.index', compact('projects', 'links'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        return view('profiles.projects.create', compact('user'));
    }

    public function store(ProjectCreateRequest $request, TagRepository $tagRepository)
    {
        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);
        
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
        
        return redirect('projects')->withOk("Le project " . $request->input('title') . " a été modifié.");
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
}
