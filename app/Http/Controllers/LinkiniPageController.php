<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LinkiniPageRepository;

class LinkiniPageController extends Controller
{


    public function __construct(LinkiniPageRepository $pageRepository)
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('admin', ['only' => ['getPendingEntreprises', 'accept']]);

        $this->pageRepository = $pageRepository;
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
        $category = $this->pageRepository->getCategory('carouselImages');

        $inputs = [
            'image' => $request->file('image'),
            'page_category_id' => $category->id
        ];

        $this->pageRepository->store($inputs);

        return redirect()->route('homepage.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
