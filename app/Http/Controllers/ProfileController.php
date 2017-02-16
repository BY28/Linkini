<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ProfileRepository;

use Auth;

class ProfileController extends Controller
{

    protected $profileRepository;
    
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->middleware('auth');
        
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.index',  compact('user'));
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
    public function store(Request $request)
    {
        //
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
        //
    }

    public function getSettings()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.settings.settings',  compact('user'));
    }

    public function getAccount()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.settings.account',  compact('user'));
    }
}
