<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseCreateRequest;
use App\Http\Requests\EntrepriseUpdateRequest;

use App\Repositories\EntrepriseRepository;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;

    protected $nbrPerPage = 9;

    public function __construct(EntrepriseRepository $entrepriseRepository)
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('admin', ['except' => 'index']);

        $this->entrepriseRepository = $entrepriseRepository;
    }
      public function index()
    {
        $entreprises = $this->entrepriseRepository->getPaginate($this->nbrPerPage);
        $links = $entreprises->render();

        return view('entreprises.index', compact('entreprises', 'links'));
    }

    public function create()
    {
        return view('entreprises.create');
    }

    public function store(EntrepriseCreateRequest $request)
    {
        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);
        
        $entreprise = $this->entrepriseRepository->store($inputs);

        return redirect('entreprise')->withOk("L'entreprise " . $entreprise->name . " a été créée.");
    }

    public function show($id)
    {
        $entreprise = $this->entrepriseRepository->getById($id);

        return view('entreprises.show',  compact('entreprise'));
    }

    public function edit($id)
    {
        $entreprise = $this->entrepriseRepository->getById($id);

        return view('entreprises.edit',  compact('entreprise'));
    }

    public function update(EntrepriseUpdateRequest $request, $id)
    {

        $this->entrepriseRepository->update($id, $request->all());
        
        return redirect('entreprise')->withOk("L'entreprise " . $request->input('name') . " a été modifiée.");
    }

    public function destroy($id)
    {
        $this->entrepriseRepository->destroy($id);

        return back();
    }
}
