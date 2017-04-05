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

        return view('profiles.settings.account',  compact('user'));
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


    /* PROJECTS */
    public function getProjects()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.projects.projects',  compact('user'));
    }
    /* END PROJECTS*/

     /* ENTREPRISE */
    public function getEntreprise()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.entreprise.entreprise',  compact('user'));
    }
    /* END ENTREPRISE*/

     /* MESSAGES */
    public function getMessages()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.messages.messages',  compact('user'));
    }
    public function getMessagesInbox()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.messages.inboox',  compact('user'));
    }
     public function getMessagesSent()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.messages.sent',  compact('user'));
    }
     public function getMessagesTrash()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.messages.trash',  compact('user'));
    }
    /* END MESSAGES*/

     /* NOTIFICATIONS */
    public function getNotifications()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.notifications.notifications',  compact('user'));
    }
    /* END NOTIFICATIONS*/

     /* STATISTICS */
    public function getStatistics()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.statistics.statistics',  compact('user'));
    }
    /* END STATISTICS*/

     /* FAVORITES */
    public function getFavorites()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.favorites.favorites',  compact('user'));
    }
    /* END FAVORITES*/

    /* SETTINGS */
    public function getSettings()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.settings.settings',  compact('user'));
    }

    public function getSettingsAccount()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.settings.account',  compact('user'));
    }

     public function getSettingsEntreprise()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.settings.entreprise',  compact('user'));
    }

     public function getSettingsNotifications()
    {
        $user = $this->profileRepository->getById(Auth::user()->id);

        return view('profiles.settings.notifications',  compact('user'));
    }
    /* END SETTINGS */


    

}
