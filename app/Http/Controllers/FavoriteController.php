<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\FavoriteRepository;

class FavoriteController extends Controller
{
    protected $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->middleware('auth');
        
        $this->favoriteRepository = $favoriteRepository;
    }


    public function getFavorites(Request $request)
    {
        $user = $request->user();
        $favorites = $this->favoriteRepository->favorites($user);

        return view('profiles.favorites.user', compact('user', 'favorites'));
    }

    public function addFav(Request $request)
    {
    	$inputs = array_merge($request->all(), ['user' => $request->user()]);
    	$this->favoriteRepository->add($inputs);
    }
}
