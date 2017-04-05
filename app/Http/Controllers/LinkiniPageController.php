<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LinkiniPageRepository;
use App\Repositories\EntrepriseRepository;
use App\Repositories\pageCategoryRepository;

class LinkiniPageController extends Controller
{


    public function __construct(LinkiniPageRepository $pageRepository, EntrepriseRepository $entrepriseRepository, pageCategoryRepository $pageCategoryRepository)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['getPendingEntreprises', 'accept']]);

        $this->pageRepository = $pageRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->pageCategoryRepository = $pageCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $carouselImages = $this->pageRepository->get();

        return view('admins.pages.homepage', compact('user', 'carouselImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCarousel(Request $request)
    {
        $category = $this->pageRepository->getCategory('home_advertisement');

        $inputs = [
            'image' => $request->file('image'),
            'page_category_id' => $category->id
        ];

        $this->pageRepository->storeAdmin($inputs);

        return redirect()->route('homepage.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($entreprise_url)
    {
        $entreprise = $this->entrepriseRepository->getByUrl($entreprise_url);

        if($entreprise)
        {
            $header_content = $this->pageRepository->getHeader($entreprise->id);
            $about_content = $this->pageRepository->getAbout($entreprise->id);
            $services_content = $this->pageRepository->getServices($entreprise->id);
            $contact_content = $this->pageRepository->getContact($entreprise->id);

            return view('pages.entreprise.index', compact('entreprise', 'header_content', 'about_content', 'services_content', 'contact_content'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function setupContent($entreprise)
    {
        $this->setupCreation('page_header', ['content_title' => $entreprise->name, 'content_text' => $entreprise->description], $entreprise->id);
        $this->setupCreation('page_about', ['content_title' => 'Qui sommes-nous ?', 'content_text' => $entreprise->description], $entreprise->id);
        $this->setupCreation('page_services', ['content_title' => 'Service 1', 'content_text' => 'Description du service'], $entreprise->id);
        $this->setupCreation('page_services', ['content_title' => 'Service 2', 'content_text' => 'Description du service'], $entreprise->id);
        $this->setupCreation('page_services', ['content_title' => 'Service 3', 'content_text' => 'Description du service'], $entreprise->id);
        $this->setupCreation('page_services', ['content_title' => 'Service 4', 'content_text' => 'Description du service'], $entreprise->id);
        $this->setupCreation('page_contact', ['content_title' => 'Contactez-nous !', 'content_text' => 'Prêt à commencer un projet avec nous ? Envoyez-nous une notification ! Nous répondrons aussi vite que possible.'], $entreprise->id);
    }

    public function setupCreation($category, $inputs, $entreprise_id)
    {
        $category = $this->pageCategoryRepository->getByName($category);

        $inputs = array_merge($inputs, ['entreprise_id' => $entreprise_id, 'page_category_id' => $category->id]);

        $this->pageRepository->store($inputs);
    }

    public function updateContent($id, Request $request)
    {

        $content = $this->pageRepository->getById($id);

        if($content->entreprise_id == $request->user()->entreprise->id)
        {

            $inputs = $request->all();
            
            if($request->has('image'))
            {
                $inputs['image'] = $this->pageRepository->moveImage($request->file('image'), config('imagePage.path'));
            }

            $this->pageRepository->update($content->id, $inputs);
        }
        if(!$request->ajax())
        {
            return redirect()->back();
        }
    }

    public function createContent($category_name, Request $request)
    {
        $category = $this->pageCategoryRepository->getByName($category_name);
        $inputs =  array_merge($request->all(), ['entreprise_id' => $request->user()->entreprise->id, 'page_category_id' => $category->id]);

        if($request->has('image'))
        {
            $inputs['image'] = $this->pageRepository->moveImage($request->file('image'), config('imagePage.path'));
        }

        $this->pageRepository->store($inputs);

        return redirect()->back();
    }

    public function deleteContent($id, Request $request)
    {
        $content = $this->pageRepository->getById($id);

        if($content->entreprise_id == $request->user()->entreprise->id)
        {
            /*
                *
                * SUPPRIMER L'iMAGE DU DOSSIER
                *
            $inputs = $request->all();
            
            if($request->input('image'))
            {
                $inputs['image'] = $this->pageRepository->moveImage($request->file('image'), config('imagePage.path'));
            }
            */

            $this->pageRepository->destroy($content->id);
        }
    }

    public function getEntrepriseInfo(Request $request)
    {
        $entreprise = $this->entrepriseRepository->getById($request->user()->entreprise->id);
        $user = $request->user();

        if($entreprise)
        {
            $header_content = $this->pageRepository->getHeader($entreprise->id);
            $about_content = $this->pageRepository->getAbout($entreprise->id);
            $services_content = $this->pageRepository->getServices($entreprise->id);
            $contact_content = $this->pageRepository->getContact($entreprise->id);

            return view('profiles.entreprise.page', compact('user', 'entreprise', 'header_content', 'about_content', 'services_content', 'contact_content'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$id = $request->input($request->input('imageId'));

         $this->pageRepository->destroy($id);
         return redirect()->back();
    }
}
