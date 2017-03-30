<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseCreateRequest;
use App\Http\Requests\EntrepriseUpdateRequest;
use App\Http\Requests\EntrepriseOrderRequest;

use App\Repositories\EntrepriseRepository;
use App\Repositories\EntrepriseOrderRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\LinkRepository;
use App\Repositories\LinkOrderRepository;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;
    protected $entrepriseOrderRepository;
    protected $categoryRepository;
    protected $projectRepository;
    protected $linkRepository;
    protected $linkOrderRepository;

    protected $nbrPerPage = 9;

    public function __construct(EntrepriseRepository $entrepriseRepository, EntrepriseOrderRepository $entrepriseOrderRepository, CategoryRepository $categoryRepository, ActivityRepository $activityRepository, LinkRepository $linkRepository, LinkOrderRepository $linkOrderRepository)
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('admin', ['only' => ['getPendingEntreprises', 'accept']]);
        $this->middleware('order', ['only' => ['getEntrepriseInfo']]);
        $this->middleware('entreprise', ['only' => ['edit', 'update', 'getEntrepriseInfo', 'getEntreprisePendingProjects']]);
        $this->entrepriseRepository = $entrepriseRepository;
        $this->entrepriseOrderRepository = $entrepriseOrderRepository;
        $this->categoryRepository = $categoryRepository;
        $this->activityRepository = $activityRepository;
        $this->linkRepository = $linkRepository;
        $this->linkOrderRepository = $linkOrderRepository;
    }
      public function index()
    {
        $entreprises = $this->entrepriseRepository->getPaginate($this->nbrPerPage);
        $links = $entreprises->render();
        $categories = $this->categoryRepository->categories();

        return view('entreprises.index', compact('entreprises', 'links', 'categories'));
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

    public function getEntrepriseInfo(Request $request)
    {
        $user = $request->user();
        return view('profiles.entreprise.informations', compact('user'));
    }

    public function getEntrepriseWaiting(Request $request)
    {
        $user = $request->user();
        return view('profiles.entreprise.waiting', compact('user'));
    }

    public function getEntrepriseOrder(Request $request)
    {
        $user = $request->user();
        $categories = $this->categoryRepository->categories();

        return view('entreprises.order', compact('user', 'categories'));
    }

    public function postEntrepriseOrder(EntrepriseOrderRequest $request)
    {
        
        $activity = $this->activityRepository->getByName($request->input('activity'));

        $inputs = [
            'user_id' => $request->user()->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'activity_id' => $activity->id,
            'category_id' => $activity->category->id
        ];

        $entreprise = $this->entrepriseOrderRepository->store($inputs);

        return redirect()->route('entreprises.info');
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

    public function indexActivity($activity)
    {
        $activityObject = $this->activityRepository->getByURL($activity);
        $entreprises = $this->entrepriseRepository->getWithUserAndActivitiesForActivityPaginate($activity, $this->nbrPerPage);
        $links = $entreprises->render();
        $categories = $this->categoryRepository->categories();

        if($activityObject)
        {
            return view('entreprises.index', compact('entreprises', 'categories', 'links'))
                    ->with('info', 'Résultats pour la recherche de l\'activité : ' . $activityObject->name);
        }
        else
        {
             return view('entreprises.index', compact('entreprises', 'categories', 'links'))
                    ->with('info', 'Aucun résultat pour la recherche de l\'activité : ' . $activity);
        }
    }

    public function indexCategory($category)
    {
        $categoryObject = $this->categoryRepository->getByURL($category);
        $entreprises = $this->entrepriseRepository->getWithUserAndCategoriesForCategoryPaginate($category, $this->nbrPerPage);
        $links = $entreprises->render();
        $categories = $this->categoryRepository->categories();

        return view('entreprises.index', compact('entreprises', 'categories', 'links'))/*
        ->with('info', 'Résultats pour la recherche de la categorie : ' . $categoryObject->name)*/;
    }

    public function indexName($query)
    {
            
            $entreprises = $this->entrepriseRepository->getEntreprisesFromName($query, $this->nbrPerPage);
            $links = $entreprises->render();
            $categories = $this->categoryRepository->categories();
            if($entreprises->count() > 0)
            {
                return view('entreprises.index', compact('entreprises', 'categories', 'links'))
                    ->with('info', 'Résultats pour la recherche : ' . $query);
            }
            else
            {
                return view('entreprises.index', compact('entreprises', 'categories', 'links'))
        ->with('info', 'Aucun résultat pour la recherche : ' . $query);
            }
    }
}
