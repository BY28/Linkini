<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseCreateRequest;
use App\Http\Requests\EntrepriseUpdateRequest;
use App\Http\Requests\EntrepriseOrderRequest;

use App\Repositories\EntrepriseRepository;
use App\Repositories\EntrepriseOrderRepository;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;
    protected $entrepriseOrderRepository;

    protected $nbrPerPage = 9;

    public function __construct(EntrepriseRepository $entrepriseRepository, EntrepriseOrderRepository $entrepriseOrderRepository)
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('entreprise', ['only' => ['edit', 'update']]);
        $this->middleware('admin', ['only' => ['getPendingEntreprises', 'accept']]);

        $this->entrepriseRepository = $entrepriseRepository;
        $this->entrepriseOrderRepository = $entrepriseOrderRepository;
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

    public function getEntrepriseOrder()
    {
        return view('entreprises.order');
    }

    public function postEntrepriseOrder(EntrepriseOrderRequest $request)
    {
        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);
        
        $entreprise = $this->entrepriseOrderRepository->store($inputs);

        return redirect()->route('entreprise.getorder')->withOk("La commande pour l'entreprise : " . $entreprise->name . " a été envoyée.");
    }

    public function getPendingEntreprises(Request $request)
    {
        $entreprises = $this->entrepriseOrderRepository->getPendingEntreprises();
        $user = $request->user();

        return view('admins.entreprises.pending', compact('entreprises', 'user'));
    }

    public function getAcceptedEntreprises(Request $request)
    {
        $entreprises = $this->entrepriseOrderRepository->getAcceptedEntreprises();
        $user = $request->user();

        return view('admins.entreprises.accepted', compact('entreprises', 'user'));
    }

    public function getCheckedEntreprises(Request $request)
    {
        $entreprises = $this->entrepriseOrderRepository->getCheckedEntreprises();
        $user = $request->user();

        return view('admins.entreprises.checked', compact('entreprises', 'user'));
    }

    public function accept(Request $request)
    {
        $this->entrepriseOrderRepository->accept($request->all());
    }

    public function check(Request $request)
    {
        $this->entrepriseOrderRepository->check($request->all());
    }
}
