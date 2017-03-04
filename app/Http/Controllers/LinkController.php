<?php

namespace App\Http\Controllers;
use App\Repositories\LinkRepository;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    protected $linkRepository;

    public function __construct(LinkRepository $linkRepository)
    {
        $this->middleware('auth');
        $this->linkRepository = $linkRepository;
    }

    public function getNotifications(Request $request)
    {
        $user = $request->user();
        $notifications = $this->linkRepository->notifications($user);

        return view('profiles.notifications.notifications', compact('user', 'notifications'));        
    }

    public function getLinks(Request $request)
    {
        $links = $this->LinkRepository->getLinks($request->user());
        $user = $request->user();

        return view('profiles.projects.links', compact('links', 'user'));
    }
    
    public function projectLink(Request $request)
    {
        $inputs = array_merge($request->all(), ['entreprise' => $request->user()->entreprise]);
        $this->linkRepository->projectLink($inputs);
    }

    public function accept(Request $request)
    {
        $this->linkRepository->accept($request->all());
    }

    public function refuse(Request $request)
    {
        $this->linkRepository->refuse($request->all());
    }

}
