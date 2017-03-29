<?php

namespace App\Http\Controllers;
use App\Repositories\LinkRepository;
use App\Repositories\LinkOrderRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\EntrepriseRepository;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    protected $linkRepository;
    protected $linkOrderRepository;
    protected $projectRepository;
    protected $entrepriseRepository;

    public function __construct(LinkRepository $linkRepository, LinkOrderRepository $linkOrderRepository, ProjectRepository $projectRepository, EntrepriseRepository $entrepriseRepository)
    {
        $this->middleware('auth');
        $this->linkRepository = $linkRepository;
        $this->linkOrderRepository = $linkOrderRepository;
        $this->projectRepository = $projectRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function getNotifications(Request $request)
    {
        $user = $request->user();
        $notifications = $this->linkRepository->notifications($user);
        $links = $notifications->render();

        return view('profiles.notifications.notifications', compact('user', 'notifications', 'links'));        
    }

    public function updateNotifications(Request $request)
    {
        $output = "";
        $user = $request->user();

        if($request->ajax())
        {

                foreach($user->notifications->reverse() as $notification)
                {
                    if(!$notification->seen)
                    {
                        $output .= '<li>
                            <a href="'.route('projects.show', $notification->project_id).'"> 
                            
                            <div class="notification-title">'. $notification->title .'</div>
                            <p>'.$notification->content.'</p>

                            </a>
                          </li>';
                    }
                }

                if($user->notifications->where('seen', false)->count() <= 0)
                {
                     $output .= '<li>
                  <a href="'.route('profile.notifications').'">
                     <div class="notification-title">Voir toutes les notifications</div>
                     <p>Pas de nouvelles notifications.</p>
                  </a>
                 </li>';
                }

                $data[0] = $output;
                $data[1] = $user->notifications->where('seen', false)->count();
               
                return Response($data);
        }

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
        if(isset($inputs['linkid']))
        {
            $this->linkOrderRepository->unlinkOrder(array_merge($inputs));
        }
    }

    public function projectUnLink(Request $request)
    {
        $inputs = array_merge($request->all(), ['entreprise' => $request->user()->entreprise]);
        if(isset($inputs['linkid']))
        {
             $this->linkRepository->projectUnLink($inputs);
        }
        else
        {
            $link_id = $this->linkRepository->getLinkId($request->user()->entreprise->id, $inputs['projectId']);
            if($link_id)
            {    
                $inputs = array_merge($inputs, ['linkid' => $link_id]);
                $this->linkRepository->projectUnLink($inputs);
            }
        }
       
    }

    public function linkOrder(Request $request)
    {
        $entreprise = $this->entrepriseRepository->getById($request->input('entrepriseId'));
        $project = $this->projectRepository->getById($request->input('projectId'));
        $inputs = array_merge($request->all(), ['entreprise' => $entreprise, 'project' => $project]);

        $this->linkOrderRepository->linkOrder($inputs);
    }

    public function unlinkOrder(Request $request)
    {
        $inputs = array_merge(['linkid' => $request->input('linkid')], ['entreprise' => $request->user()->entreprise]);
        $this->linkOrderRepository->unlinkOrder($inputs);
    }

    public function attributionAccept(Request $request)
    {
        $link = $this->linkRepository->getById($request->input('linkId'));
        $this->linkRepository->attributionAccept($link);
    }

    public function attributionCancel(Request $request)
    {
        $link = $this->linkRepository->getById($request->input('linkId'));
        $this->linkRepository->attributionCancel($link);
    }

    public function attributionConfirm(Request $request)
    {
        $link = $this->linkRepository->getById($request->input('linkId'));
        $this->linkRepository->attributionConfirm($link);
    }

    public function accept(Request $request)
    {
        $this->linkRepository->accept($request->all());
    }

    public function refuse(Request $request)
    {
        $this->linkRepository->refuse($request->all());
    }

    public function getPendingProjects(Request $request)
    {
        $user = $request->user();
        $links = $this->linkOrderRepository->getPendingProjects($user->entreprise->id);

        return view('profiles.entreprise.pending', compact('links', 'user'));
    }

    public function getAttributionProjects(Request $request)
    {
        $user = $request->user();
        $links = $this->linkRepository->getAttributionProjects($user->entreprise->id);

        return view('profiles.entreprise.attribution', compact('links', 'user'));
    }

    public function getLaunchedProjects(Request $request)
    {
        $user = $request->user();
        $links = $this->linkRepository->getLaunchedProjects($user->entreprise->id);

        return view('profiles.entreprise.launched', compact('links', 'user'));
    }

    public function getCanceledProjects(Request $request)
    {
        $user = $request->user();
        $links = $this->linkRepository->getCanceledProjects($user->entreprise->id);

        return view('profiles.entreprise.canceled', compact('links', 'user'));
    }

    public function getUserAttributionProjects(Request $request)
    {
        $user = $request->user();
        $links = $this->linkRepository->getUserAttributionProjects($user->id);

        return view('profiles.projects.attribution', compact('links', 'user'));
    }

    public function getUserLaunchedProjects(Request $request)
    {
        $user = $request->user();
        $links = $this->linkRepository->getUserLaunchedProjects($user->id);

        return view('profiles.projects.launched', compact('links', 'user'));
    }

    public function getProjectsCanceled(Request $request)
    {
        $user = $request->user();
        $links = $this->linkRepository->getProjectsCanceled($user->id);

        return view('profiles.projects.canceled', compact('links', 'user'));
    }

}
