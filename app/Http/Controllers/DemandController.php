<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandCreateRequest;
use App\Http\Requests\DemandUpdateRequest;

use App\Repositories\DemandRepository;
use App\Repositories\TagRepository;

use Illuminate\Http\Request;

class DemandController extends Controller
{
    protected $demandRepository;

    protected $nbrPerPage = 9;

    public function __construct(DemandRepository $demandRepository)
    {
        $this->middleware('auth', ['except' => 'index']);

        $this->demandRepository = $demandRepository;
    }
      public function index()
    {
        $demands = $this->demandRepository->getPaginate($this->nbrPerPage);
        $links = $demands->render();
        
        return view('demands.index', compact('demands', 'links'));
    }

    public function create()
    {
        return view('demands.create');
    }

    public function store(DemandCreateRequest $request, TagRepository $tagRepository)
    {
        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);
        
        $demand = $this->demandRepository->store($inputs);

        if(isset($inputs['tag']))
        {
            $tagRepository->attach($demand, $inputs['tag']);
        }

        return redirect('demand')->withOk("La demande " . $demand->title . " a été créée.");
    }

    public function show($id)
    {
        $demand = $this->demandRepository->getById($id);

        return view('demands.show',  compact('demand'));
    }

    public function edit($id)
    {
        $demand = $this->demandRepository->getById($id);

        return view('demands.edit',  compact('demand'));
    }

    public function update(DemandUpdateRequest $request, $id)
    {

        $this->demandRepository->update($id, $request->all());
        
        return redirect('demand')->withOk("La demande " . $request->input('title') . " a été modifiée.");
    }

    public function destroy($id)
    {
        $this->demandRepository->destroy($id);

        return back();
    }

    public function indexTag($tag)
    {
        $demands = $this->demandRepository->getWithUserAndTagsForTagPaginate($tag, $this->nbrPerPage);
        $links = $demands->render();

        return view('demands.liste', compact('demands', 'links'))
        ->with('info', 'Résultats pour la recherche du mot-clé : ' . $tag);
    }
}
